<style>
p, h2, h3 {padding:0px; margin: 0px;}
.border-tr {border: 1px solid;}
</style>
<?php if ($quizes) { ?>
  <table>
    <tr>
      <td colspan="3">
        <h2><?php echo esc_output($quizes[0]['first_name'].' '.$quizes[0]['last_name'], 'html'); ?> 
        (<?php echo esc_output($quizes[0]['quizes_result'], 'html'); ?>%)
        </h2>
      </td>
    </tr>
    <tr><td colspan="3"><br /></td></tr>
    <?php foreach ($quizes as $value) { ?>
      <?php $quiz = objToArr(json_decode($value['quiz_data'])); ?>
      <?php $user_answers = objToArr(json_decode($value['answers_data'])); ?>
      <tr>
        <td colspan="3">
          <u><h3>
            <?php echo esc_output($value['quiz_title'], 'html'); ?>
            (<?php echo esc_output($value['total_questions'], 'raw') != 0 ? round(($value['correct_answers']/$value['total_questions'])*100) : '0'; ?>%)
          </h3></u>
        </td>
      </tr>
      <tr><td colspan="3"><br /></td></tr>
      <?php foreach ($quiz['questions'] as $i => $question) { ?>
        <tr>
          <td colspan="3">
            <strong><?php echo ($i+1).': '.$question['title']; ?></strong>
            <br />
          </td>
        </tr>
        <?php foreach ($question['answers'] as $answer) { ?>
        <?php $user_answer = isset($user_answers[$i]) ? $user_answers[$i] : ''; ?>
        <tr class="border-tr">
          <td class="border-tr"><?php echo esc_output($answer['title'], 'html'); ?></td>
          <td class="border-tr"><?php echo esc_output($answer['is_correct'], 'raw') ? 'Correct' : ''; ?></td>
          <td class="border-tr"><?php echo checkQuizCorrect($user_answer, $answer['quiz_question_answer_id'], $question['type']); ?></td>
        </tr>
        <?php } ?>
      <?php } ?>
      <tr><td colspan="3"><br /><br /></td></tr>
    <?php } ?>
  </table>
  <hr />
<?php } else { ?>
<?php } ?>
