<style>
p, h2, h3 {padding:0px; margin: 0px;}
ul li {list-style: none; text-decoration: none;}
</style>
<?php if ($quiz) { ?>
  <table>
    <tr>
      <td colspan="2">
        <h2><?php echo esc_output($quiz['title'], 'html'); ?></h2>
        <br />
        <h3><?php echo lang('description'); ?></h3>
        <p>
          <?php echo esc_output($quiz['description'], 'html'); ?>
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
        <p><?php echo esc_output($key)+1 .'. '. $question['title']; ?></p>
        <?php if ($question['image']) { ?>
        <img src="<?php echo questionThumb2($question['image']); ?>" height="100"/>
        <?php } ?>
      </td>
      </tr>
      <tr>
      <td colspan="2">
        <?php if ($question['answers']) { ?>
        <div>
          <ul>
          <?php foreach ($question['answers'] as $answer) { ?>
            <li>
              <input type="<?php echo esc_output($question['type']); ?>" /> <?php echo esc_output($answer['title'], 'html'); ?>
            </li>
          <?php } ?>
          </ul>
        </div>
        <?php } else { ?>
          <p><?php echo lang('there_are_no_answers'); ?></p>
        <?php } ?>
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
  <p><?php echo lang('no_quiz_found'); ?></p>
<?php } ?>