<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Glossary
 * @author    Codeat <support@codeat.co>
 * @license   GPL-2.0+
 * @link      http://codeat.co
 * @copyright 2016 GPL 2.0+
 */
?>

<div class="wrap">

    <h2>Glossary General Settings</h2>

    <div id="tabs" class="settings-tab">
        <ul>
            <li><a href="#tabs-1"><?php _e( 'Settings' ); ?></a></li>
            <li><a href="#tabs-2"><?php _e( 'Import/Export', $this->plugin_slug ); ?></a></li>
		<?php do_action( 'glossary_settings_tabs' ); ?>
        </ul>
        <div id="tabs-1" class="wrap">
            <?php
            $cmb = new_cmb2_box( array(
                'id' => $this->setting_slug . '_options',
                'hookup' => false,
                'show_on' => array( 'key' => 'options-page', 'value' => array( $this->plugin_slug ), ),
                'show_names' => true,
                    ) );
            $cmb->add_field( array(
                'name' => __( 'Enable in:', $this->plugin_slug ),
                'id' => 'posttypes',
                'type' => 'multicheck_posttype',
            ) );
            $cmb->add_field( array(
                'name' => __( 'Enable also in following archives:', $this->plugin_slug ),
                'id' => 'is',
                'type' => 'multicheck',
                'options' => array(
                    'home' => __( 'Home', $this->plugin_slug ),
                    'category' => __( 'Category archive', $this->plugin_slug ),
                    'tag' => __( 'Tag archive', $this->plugin_slug ),
                    'arc_glossary' => __( 'Glossary Archive', $this->plugin_slug ),
                    'tax_glossary' => __( 'Glossary Taxonomy', $this->plugin_slug )
                )
            ) );
            $cmb->add_field( array(
                'name' => __( 'Order Glossary terms archive alphabetically', $this->plugin_slug ),
                'id' => 'order_terms',
                'type' => 'checkbox',
            ) );
            $cmb->add_field( array(
                'name' => __( 'Link only the first occurence', $this->plugin_slug ),
                'desc' => __('Prevent duplicate links and tooltips in the same post', $this->plugin_slug ),
                'id' => 'first_occurence',
                'type' => 'checkbox',
            ) );
            $cmb->add_field( array(
                'name' => __( 'Enable tooltips on terms', $this->plugin_slug ),
                'desc' => __('Tooltip will popup on hover', $this->plugin_slug ),
                'id' => 'tooltip',
                'type' => 'checkbox',
            ) );
            $cmb->add_field( array(
                'name' => __( 'Tooltip style', $this->plugin_slug ),
                'desc' => __('Only classic shows featured images', $this->plugin_slug ),
                'id' => 'tooltip_style',
                'type' => 'select',
                'options' => array(
                    'classic' => 'Classic',
                    'box' => 'Box',
                    'line' => 'Line',
                )
            ) );
            $cmb->add_field( array(
                'name' => __( 'Excerpt length', $this->plugin_slug ),
                'id' => 'excerpt_limit',
                'type' => 'text_number',
                'default' => '60'
            ) );
            $cmb->add_field( array(
                'name' => __( 'Enable image in tooltip', $this->plugin_slug ),
                'desc' => __( 'Check it if you want also term\'s featured image in classic tooltips', $this->plugin_slug ),
                'id' => 't_image',
                'type' => 'checkbox',
            ) );
            $cmb->add_field( array(
                'name' => __( 'Glossary Terms slug', $this->plugin_slug ),
                'id' => 'slug',
                'type' => 'text_small',
                'default' => 'glossary'
            ) );
            $cmb->add_field( array(
                'name' => __( 'Glossary category slug', $this->plugin_slug ),
                'id' => 'slug-cat',
                'type' => 'text_small',
                'default' => 'glossary-cat'
            ) );
            $cmb->add_field( array(
                'name' => __( 'Disable Archive page for Glossary Terms', $this->plugin_slug ),
                'desc' => __( 'Don\'t forget to flush the permalinks', $this->plugin_slug ),
                'id' => 'archive',
                'type' => 'checkbox',
            ) );
            $cmb->add_field( array(
                'name' => __( 'Add Glossary Terms post type in the website search', $this->plugin_slug ),
                'desc' => __( 'Add the post type to the others, in few case only this post type is enabled', $this->plugin_slug ),
                'id' => 'search',
                'type' => 'checkbox',
            ) );
            cmb2_metabox_form( $this->setting_slug . '_options', $this->setting_slug . '-settings' );
            ?>

            <!-- @TODO: Provide other markup for your options page here. -->
        </div>
        <div id="tabs-2" class="metabox-holder">
            <div class="postbox">
                <h3 class="hndle"><span><?php _e( 'Export Settings', $this->plugin_slug ); ?></span></h3>
                <div class="inside">
                    <p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.', $this->plugin_slug ); ?></p>
                    <form method="post">
                        <p><input type="hidden" name="g_action" value="export_settings" /></p>
                        <p>
                            <?php wp_nonce_field( 'g_export_nonce', 'g_export_nonce' ); ?>
                            <?php submit_button( __( 'Export' ), 'secondary', 'submit', false ); ?>
                        </p>
                    </form>
                </div>
            </div>

            <div class="postbox">
                <h3 class="hndle"><span><?php _e( 'Import Settings', $this->plugin_slug ); ?></span></h3>
                <div class="inside">
                    <p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', $this->plugin_slug ); ?></p>
                    <form method="post" enctype="multipart/form-data">
                        <p>
                            <input type="file" name="g_import_file"/>
                        </p>
                        <p>
                            <input type="hidden" name="g_action" value="import_settings" />
                            <?php wp_nonce_field( 'g_import_nonce', 'g_import_nonce' ); ?>
                            <?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
	   <?php do_action( 'glossary_settings_panels' ); ?>
    </div>
    <!-- Begin MailChimp  -->
    <div class="right-column-settings-page metabox-holder">
        <div class="postbox codeat newsletter">
            <h3 class="hndle"><span><?php _e( 'Codeat Newsletter', $this->plugin_slug ); ?></span></h3>
            <div class="inside">
            <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="//codeat.us12.list-manage.com/subscribe/post?u=07eeb6c8b7c0e093817bd29d1&amp;id=8e8f10fb4d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll"> 
                            <div class="mc-field-group">
                                <label for="mce-EMAIL">Email Address </label>
                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>
                            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                <input type="text" name="b_07eeb6c8b7c0e093817bd29d1_8e8f10fb4d" tabindex="-1" value="">
                            </div>
                            <div class="clear">
                                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                            </div>
                        </div>
                    </form>
                </div>
                <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
                <script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            </div>
        </div>
    </div>
    <!-- Begin Social Links -->
    <div class="right-column-settings-page metabox-holder">
        <div class="postbox codeat social">
            <h3 class="hndle"><span><?php _e( 'Follow us', $this->plugin_slug ); ?></span></h3>
            <div class="inside">
                <a href="https://facebook.com/codeatco/" target="_blank"><img src="http://i2.wp.com/codeat.co/wp-content/uploads/2016/02/social-facebook.png?w=52" alt="facebook"></a>
                <a href="https://twitter.com/codeatco/" target="_blank"><img src="http://i0.wp.com/codeat.co/wp-content/uploads/2016/02/social-twitter.png?w=52" alt="twitter"></a>
                <a href="https://linkedin.com/company/codeat/" target="_blank"><img src="http://i1.wp.com/codeat.co/wp-content/uploads/2016/02/social-linkedin.png?w=52" alt="linkedin"></a>
            </div>
        </div>
    </div>
    <!-- Begin Plugin List -->
    <div class="right-column-settings-page metabox-holder">
        <div class="postbox codeat">
            <h3 class="hndle"><span><?php _e( 'A Codeat Plugin', $this->plugin_slug ); ?></span></h3>
            <div class="inside">
                <a href="http://codeat.co" target="_blank"><img src="http://i2.wp.com/codeat.co/wp-content/uploads/2016/02/cropped-logo-light.png?w=236" alt="Codeat"></a>
                <a href="http://codeat.co/glossary/" target="_blank"><img src="http://i0.wp.com/codeat.co/glossary/wp-content/uploads/sites/3/2016/02/cropped-Glossary_logo-ori-Lite-1.png?w=236" alt="Glossary For WordPress"></a>
                <a href="http://codeat.co/pinit/" target="_blank"><img src="http://i1.wp.com/codeat.co/pinit/wp-content/uploads/sites/2/2016/02/cropped-PinterestForWP_logo-ori-Lite-1.png?w=236" alt="Pinterest for WordPress"></a>
                <a href="http://codeat.co/video-ad/" target="_blank"><img src="http://i1.wp.com/codeat.co/video-ad/wp-content/uploads/sites/4/2016/02/cropped-VideoAd_logo-ori-Lite.png?w=236" alt="Video Ad Plugin For WordPress"></a>
                <a href="http://codeat.co/track-changes/" target="_blank"><img src="http://i2.wp.com/codeat.co/track-changes/wp-content/uploads/sites/5/2016/02/cropped-Track-Changes_logo-ori-Lite-1.png?w=236" alt="Track Changes For WordPress"></a>
            </div>
        </div>
    </div>
</div>