<form id="interview_conduct_form">
  <input type="hidden" name="candidate_interview_id" value="<?php echo esc_output($candidate_interview['candidate_interview_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <?php $interview = $candidate_interview['interview_data'] ? objToArr(json_decode($candidate_interview['interview_data'])) : array(); ?>
      <?php $answers = $candidate_interview['answers_data'] ? objToArr(json_decode($candidate_interview['answers_data'])) : array(); ?>
      <?php foreach ($interview['questions'] as $key => $question) { ?>
        <div class="col-md-12">
          <div class="form-group">
            <label><?php echo ($key+1).': '.esc_output($question['title'], 'html'); ?></label>
            <?php if ($candidate_interview['status'] == 0) { ?>
            <select class="pill-rating" name="ratings[]" autocomplete="off">
              <option value="0" selected="selected">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
            <?php } else { ?>
              <?php if (isset($answers[$key]['rating'])) { ?>
              <p><?php echo esc_output($answers[$key]['rating'], 'html'); ?>/10</p>
              <?php } else { ?>
                ---
              <?php }?>
            <?php }?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label><?php echo lang('comments'); ?></label>
            <?php if ($candidate_interview['status'] == 0) { ?>
            <input type="text" class="form-control" name="comments[]" placeholder="<?php echo lang('comments'); ?>">
            <?php } else { ?>
            <?php if (isset($answers[$key])) { ?>
            <p><?php echo trimString(esc_output($answers[$key]['comment'], 'html')); ?></p>
            <?php } else { ?>
              ---
            <?php }?>
            <?php }?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <hr />
          </div>
        </div>
      <?php } ?>
    </div>          
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <?php if ($candidate_interview['status'] == 0) { ?>
    <button type="submit" class="btn btn-primary btn-blue" id="interview_conduct_form_button"><?php echo lang('save'); ?></button>
    <?php } ?>
  </div>
</form>
