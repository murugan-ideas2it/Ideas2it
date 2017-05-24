<?php defined('ABSPATH') or die;

/*
 * Simple Wp Sitemap options
 */

class SimpleWpMapOptions {
    private $error = '';

    // Returns a sitemap url
    public function getSitemapUrl ($format) {
        return sprintf('%ssitemap.%s', home_url('/'), $format);
    }

    // Returns default order option
    public function getDefaultOrder () {
        return array('home' => array('title' => __('Home', 'simple-wp-sitemap'), 'i' => 1), 'posts' => array('title' => __('Posts', 'simple-wp-sitemap'), 'i' => 2), 'pages' => array('title' => __('Pages', 'simple-wp-sitemap'), 'i' => 3), 'other' => array('title' => __('Other', 'simple-wp-sitemap'), 'i' => 4), 'categories' => array('title' => __('Categories', 'simple-wp-sitemap'), 'i' => 5), 'tags' => array('title' => __('Tags', 'simple-wp-sitemap'), 'i' => 6), 'authors' => array('title' => __('Authors', 'simple-wp-sitemap'), 'i' => 7));
    }

    // Updates all options
    public function setOptions ($otherUrls, $blockUrls, $attrLink, $categories, $tags, $authors, $orderArray, $lastUpdated, $blockHtml, $orderby) {
        @date_default_timezone_set(get_option('timezone_string'));
        update_option('simple_wp_other_urls', $this->addUrls($otherUrls, get_option('simple_wp_other_urls')));
        update_option('simple_wp_block_urls', $this->addUrls($blockUrls));
        update_option('simple_wp_attr_link', intval($attrLink));
        update_option('simple_wp_disp_categories', intval($categories));
        update_option('simple_wp_disp_tags', intval($tags));
        update_option('simple_wp_disp_authors', intval($authors));
        update_option('simple_wp_block_html', sanitize_text_field($blockHtml));
        update_option('simple_wp_last_updated', sanitize_text_field(stripslashes($lastUpdated)));
        update_option('simple_wp_order_by', sanitize_text_field($orderby));

        if (($orderArray = $this->checkOrder($orderArray)) && uasort($orderArray, array($this, 'sortArr'))) { // sort the array here
            update_option('simple_wp_disp_sitemap_order', $orderArray);
        }
    }

    // Prints checked for option
    public function printChecked ($opt) {
        echo get_option($opt) ? 'checked' : '';
    }

    // Prints selected for option
    public function printSelected ($opt, $val) {
        echo get_option($opt) == $val ? 'selected' : '';
    }

    // Prints admin form submit url
    public function printSubmitUrl () {
        echo esc_url(admin_url('options-general.php?page=simpleWpSitemapSettings'));
    }

    // Prints urls in textarea
    public function printUrls ($opt) {
        $urls = get_option($opt);

        if ($urls && is_array($urls)) {
            foreach ($urls as $sArr) {
                echo esc_url($sArr['url']) . "\n";
            }
        }
    }

    // Adds new urls to the sitemaps
    public function addUrls ($urls, $oldUrls = null) {
        $arr = array();
        $urls = trim($urls);

        if ($urls) {
            $urls = explode("\n", $urls);

            foreach ($urls as $url){
                if ($url = esc_url(trim($url))) {
                    $isOld = false;
                    if ($oldUrls && is_array($oldUrls)) {
                        foreach ($oldUrls as $oldUrl) {
                            if ($oldUrl['url'] === $url && !$isOld) {
                                array_push($arr, $oldUrl);
                                $isOld = true;
                            }
                        }
                    }
                    if (!$isOld && strlen($url) < 2000) {
                        array_push($arr, array('url' => $url, 'date' => time()));
                    }
                }
            }
        }
        return $arr;
    }

    // Checks if orderArray is valid
    public function checkOrder ($orderArray) {
        if (is_array($orderArray)) {
            foreach ($orderArray as $title => $arr) {
                if (!is_array($arr) || !preg_match('/^[1-7]{1}$/', $arr['i']) || (!($orderArray[$title]['title'] = sanitize_text_field(stripslashes($arr['title']))))) {
                    return false;
                }
            }
            return $orderArray;
        }
        return false;
    }

    // Sort function for uasort
    public function sortArr ($a, $b) {
        return $a['i'] - $b['i'];
    }

    // Upgrades the plugin to premium
    public function upgradePlugin ($code) {
        $url = esc_url('https://www.webbjocke.com/downloads/update/'); // make sure it's https
        $args = array('action' => 'verify', 'object' => 'simple-wp-sitemap-premium', 'ver' => 'newest', 'code' => sanitize_text_field($code));

        try {
            if (!$args['code']) {
                throw new Exception(__('Please enter a code', 'simple-wp-sitemap'));
            }
            if (!class_exists('ZipArchive')) {
                throw new Exception(__('Your server does not support ZipArchive. Please install the upgrade manually', 'simple-wp-sitemap'));
            }

            update_option('simple_wp_premium_code', $args['code']);
            $res = wp_remote_post($url, array('body' => $args));

            if (is_wp_error($res) || $res['response']['code'] !== 200) {
                throw new Exception(__('Could not connect to server. Please try again later', 'simple-wp-sitemap'));
            }
            if ($res['body'] !== 'ok') {
                throw new Exception($res['body']);
            }

            $args['action'] = 'download';
            $file = download_url(add_query_arg($args, $url));

            if (is_wp_error($file)) {
                throw new Exception($file->get_error_message());
            }

            $zip = new ZipArchive();
            $uploaded = file_exists($file) && $zip->open($file) === true && $zip->extractTo(plugin_dir_path(__FILE__));
            $zip->close();
            unlink($file);

            if (!$uploaded) {
                throw new Exception(__('Failed to install the upgrade. You might have to download and install the upgrade manually', 'simple-wp-sitemap'));
            }
            $this->redirect();

        } catch (Exception $ex) {
            $this->error = sanitize_text_field($ex->getMessage());
        }
    }

    // Error message if upgrade went wrong
    public function printError () {
        if ($this->error) {
            echo esc_html($this->error);
        }
    }

    // Deletes old or current sitemap files and updates order options
    public function migrateFromOld () {
        if (function_exists('get_home_path')) {
            try {
                $path = sprintf('%ssitemap.', get_home_path());

                foreach (array('xml', 'html') as $file) {
                    if (file_exists($path . $file)) {
                        unlink($path . $file);
                    }
                }
            } catch (Exception $ex) {
                return;
            }
        }

        if ($order = get_option('simple_wp_disp_sitemap_order')) {
            foreach ($order as $key => $val) {
                if (is_array($val)) { // It's ok
                    break;
                }
                $order[lcfirst($key)] = array('title' => $key, 'i' => $val);
                unset($order[$key]);
            }
        } else {
            $order = $this->getDefaultOrder();
        }
        update_option('simple_wp_disp_sitemap_order', $order);
        return $order;
    }

    // Redirect function on successful upgrade to premium
    public function redirect () { ?>
        <h1><?php _e('Successfully upgraded to Simple Wp Sitemap Premium!', 'simple-wp-sitemap'); ?></h1>
        <p><?php _e('Redirecting in 3 seconds', 'simple-wp-sitemap'); ?></p>
        <script>
            setTimeout(function () {
                window.location.href="<?php $this->printSubmitUrl(); ?>";
            }, 3000);
        </script>
        <?php exit;
    }
}
