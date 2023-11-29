<style>
p, h2, h3 {padding:0px; margin: 0px;}
ul li {list-style: none; text-decoration: none;}
</style>
<?php if ($interview) { ?>
  <table>
    <tr>
      <td colspan="2">
        <h2><?php echo esc_output($interview['title'], 'html'); ?></h2>
        <br />
        <h3><?php echo lang('description'); ?></h3>
        <p>
          <?php echo esc_output($interview['description'], 'html'); ?>
        </p>
        <br />
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <h3><?php echo lang('questions'); ?></h3>      
      </td>
    </tr>
    
    <?php if ($questions) { ?>
    <?php foreach ($questions as $key => $question) { ?>
      <tr>
      <td colspan="2">
        <p><?php echo esc_output($key+1) .'. '. $question['title']; ?></p>
        <br /><br />
      </td>
      </tr>
    <?php } ?>
    <?php } else { ?>
      <tr>
      <td><p><?php echo lang('there_are_no_questions'); ?></p></td>
      </tr>
    <?php } ?>
    
  </table>
  <hr />
<?php } else { ?>
  <p><?php echo lang('no_interview_found'); ?></p>
<?php } ?>