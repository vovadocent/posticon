<?php
$enabled = $options['pi_enabled'] == true ? 'checked' : '';
$pi_posts = $options['pi_posts'];
?>
<div class="wrap">
    <h1>Post Icon Settings</h1>

    <form method="post" action="<?php echo admin_url('options-general.php?page=pi-options'); ?>">

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">General settings</th>
                    <td>
                        <fieldset>
                            <?php ?>
                            <label for="default_pingback_flag">
                                <input name="pi_enabled"
                                       type="checkbox"
                                       id="default_pingback_flag"
                                       value="1"
                                       <?php echo $enabled; ?> >
                                Enable Post Icons
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <?php if (count($posts)) { ?>
                    <tr>
                        <th scope="row">
                            Configure Posts
                        </th>
                        <td>

                            <?php
                            foreach ($posts as $p) {
                                $post_id = $p->ID;
                                if ( isset( $pi_posts[$post_id] ) ) {
                                    $checked = 'checked';
                                    $cur_pos = $pi_posts[$post_id]['position'];
                                    $cur_ico = $pi_posts[$post_id]['icon'];
                                } else {
                                    $checked = $cur_pos = $cur_ico = '';
                                }
                                ?>
                                <fieldset>
                                    <label for="post_id_<?php echo $post_id; ?>">
                                        <input name="pi_posts[]"
                                               type="checkbox"
                                               id="post_id_<?php echo $post_id; ?>"
                                               value="<?php echo $post_id; ?>"
                                               <?php echo $checked; ?> >
                                        Enable Icon For "<b><?php echo $p->post_title; ?></b>"
                                    </label>
                                    <br>
                                    <label for="icon_position_<?php echo $post_id; ?>">
                                        Position:
                                        <select name="icon_positions[<?php echo $post_id; ?>]" id="icon_position_<?php echo $post_id; ?>">
                                            <?php
                                            foreach ($positions as $pos) {
                                                $selected = $pos == $cur_pos ? 'selected' : '';
                                                ?>
                                                <option value="<?php echo $pos; ?>" <?php echo $selected; ?>>
                                                    <?php echo $pos; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <label for="icon_<?php echo $post_id; ?>">
                                        Icon:
                                        <select name="icons[<?php echo $post_id; ?>]" id="icon_<?php echo $post_id; ?>">
                                            <?php
                                            foreach ($icons as $ico) {
                                                $selected = $ico == $cur_ico ? 'selected' : '';
                                                ?>
                                                <option value="<?php echo $ico; ?>" <?php echo $selected; ?>>
                                                    <?php echo $ico; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </fieldset>
                            <?php } ?>

                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
        </p>

        <input type="hidden" name="action" value="pi_save_settings">
        <?php /* <input type="hidden" id="_wpnonce" name="_wpnonce" value="b694e21d7c"> */ ?>

    </form>

</div>