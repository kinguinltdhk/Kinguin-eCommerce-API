<?php 


/**
 * author: Andrzej Skowron
 * email: skwrn@outlook.com
 * 
 * Woocommerce - Kinguin API intergration
 */

class KinguinApiSettingsPage
{
    private $options;

    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_plugin_page()
    {
        // This page is located under "Settings"
        add_options_page(
            'Settings Admin', 
            'Kinguin API Settings', 
            'manage_options', 
            'ask-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    // Options page callback
    public function create_admin_page()
    {
        $this->options = get_option( 'ask_option_margin' );
        ?>
        <div class="wrap">
            <h2>Kinguin API Settings</h2>           
            <form method="post" action="options.php">
            <?php
                settings_fields( 'ask_option_group' );   
                do_settings_sections( 'ask-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    // Register and add settings
    public function page_init()
    {        
        register_setting(
            'ask_option_group', // Option group
            'ask_option_margin', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            '-----------------', // Title
            array( $this, 'print_section_info' ), // Callback
            'ask-setting-admin' // Page
        );  

        add_settings_field(
            'margin', // ID
            'Price Margin', // Title 
            array( $this, 'margin_callback' ), // Callback
            'ask-setting-admin', // Page
            'setting_section_id' // Section           
        );      

    }

    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['margin'] ) )
            $new_input['margin'] = absint( $input['margin'] );


        return $new_input;
    }

    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    public function margin_callback()
    {
        printf(
            '<input type="text" id="margin" name="ask_option_margin[margin]" value="%s" />',
            isset( $this->options['margin'] ) ? esc_attr( $this->options['margin']) : ''
        );
    }
}

if( is_admin() )
    $ask_settings_page = new KinguinApiSettingsPage();
