<style>
p, h2, h3 {padding:0px; margin: 0px;}
</style>
<?php if ($trait) { ?>
  <table>
    <tr>
      <td colspan="2">
        <h2><?php echo esc_output($trait['first_name'].' '.$trait['last_name'], 'html'); ?> 
        (<?php echo ($trait['trait_overall']/(count($trait['traits'])*5))*100; ?>%)
        </h2>
      </td>
    </tr>
    <?php foreach ($trait['traits'] as $value) { ?>
    <tr>
      <td>
      <h4><?php echo esc_output($value['title'], 'html'); ?></h4>
      </td>
      <td>
      <h4><?php echo $value['rating']; ?>/5 (<?php echo ($value['rating']/5)*100; ?>%)</h4>
      </td>
    </tr>
    <?php } ?>
  </table>
  <hr />
<?php } else { ?>
<?php } ?>