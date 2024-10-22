<?php
$options = get_option($this->option_name);
?>

<div class="wrap">
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" name="ai_shop_assistant_options" action="options.php">
    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>
        <table class="form-table" role="presentation">
            <tr>
                <th scope="row">
                    <label for="<?php echo $this->option_name; ?>[enabled]"><?php _e('Enable Plugin', $this->plugin_name); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="<?php echo $this->option_name; ?>[enabled]" name="<?php echo $this->option_name; ?>[enabled]" value="1" <?php checked($options['enabled'], 1); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo $this->option_name; ?>[openai_api_key]"><?php _e('OpenAI API Key', $this->plugin_name); ?></label>
                </th>
                <td>
                    <input type="text" id="<?php echo $this->option_name; ?>[openai_api_key]" name="<?php echo $this->option_name; ?>[openai_api_key]" value="<?php echo $options['openai_api_key']; ?>" class="regular-text" />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo $this->option_name; ?>[button_position]"><?php _e('Button Position', $this->plugin_name); ?></label>
                </th>
                <td>
                    <select id="<?php echo $this->option_name; ?>[button_position]" name="<?php echo $this->option_name; ?>[button_position]">
                        <option value="left" <?php selected($options['button_position'], 'left'); ?>><?php _e('Left', $this->plugin_name); ?></option>
                        <option value="right" <?php selected($options['button_position'], 'right'); ?>><?php _e('Right', $this->plugin_name); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo $this->option_name; ?>[button_text]"><?php _e('Button Text', $this->plugin_name); ?></label>
                </th>
                <td>
                    <input type="text" id="<?php echo $this->option_name; ?>[button_text]" name="<?php echo $this->option_name; ?>[button_text]" value="<?php echo $options['button_text']; ?>" class="regular-text" />
                </td>
            </tr>
        </table>
        <?php submit_button('Save Settings', 'primary', 'submit', true); ?>
    </form>
</div>
