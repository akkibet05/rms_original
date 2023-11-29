<style>
p, h2, h3 {padding:0px; margin: 0px;}
</style>
<?php if ($interviews) { ?>
  <table>
    <tr>
      <td colspan="2">
        <h2><?php echo esc_output($interviews[0]['first_name'].' '.$interviews[0]['last_name'], 'html'); ?> 
        (<?php echo esc_output($interviews[0]['interviews_result'], 'html'); ?>%)
        </h2>
      </td>
    </tr>
    <?php foreach ($interviews as $value) { ?>
    <?php $interview = objToArr(json_decode($value['interview_data'])); ?>
    <?php $answers = objToArr(json_decode($value['answers_data'])); ?>
    <tr>
      <td colspan="2">
        <u><h3>
          <?php echo esc_output($value['interview_title'], 'html'); ?>
          <?php if ($value['total_questions'] > 0) { ?>
          (<?php echo round(($value['overall_rating']/($value['total_questions']*10))*100); ?>%)
          <?php } else { ?>
          (0%)
          <?php } ?>
        </h3></u>
      </td>
    </tr>
      <?php if ($interview['questions']) { ?>
      <?php foreach ($interview['questions'] as $i => $question) { ?>
      <tr>
        <td>
          <strong><?php echo esc_output($question['title'], 'html'); ?></strong>
          <?php if (isset($answers[$i]['comment']) && $answers[$i]['comment']) { ?>
          <br /><?php echo lang('comment'); ?> : <?php echo esc_output($answers[$i]['comment'], 'html'); ?>
          <?php } else { ?>
          <br /><?php echo lang('comment'); ?> : ---
          <?php } ?>
        </td>
        <td><?php echo isset($answers[$i]['rating']) ? $answers[$i]['rating'].'/10' : '---'; ?></td>
      </tr>
      <?php } ?>
      <?php } ?>
    <?php } ?>
  </table>
  <hr />
<?php } else { ?>
<?php } ?>