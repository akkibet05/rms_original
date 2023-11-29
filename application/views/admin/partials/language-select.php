<?php if ($languages) { ?>
<select id="admin-language-selector" class="selectpicker countrypicker" data-width="fit">
  <?php $admin_lang = adminLanguage() ? adminLanguage() : defaultLanguage(); ?>
  <?php foreach ($languages as $l) { ?>
    <?php 
      $flag = 'flag-icon flag-icon-'.esc_output($l['flag']);
      $title = esc_output($l['title']);
      if ($l['display'] == 'only_title') {
        $content = '<span class=""></span>'.$title;
      } elseif ($l['display'] == 'only_flag') {
        $content = '<span class="'.$flag.'"></span>';
      } else {
        $content = '<span class="'.$flag.'"></span> '.$title;
      }

      $selected = $l['slug'] == $admin_lang ? 'selected' : '';
    ?>
    <option data-direction="<?php echo esc_output($l['direction']); ?>"
      data-content='<?php echo esc_output($content, "html"); ?>' <?php echo esc_output($selected); ?>>
      <?php echo esc_output($l['slug']); ?>
    </option>
  <?php } ?>
</select>
<?php } ?>