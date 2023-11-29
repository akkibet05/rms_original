<?php if ($resume) { ?>
<style>
    p, h2, h3 {padding:0px; margin: 0px;}
    * { font-family: DejaVu Sans, sans-serif; direction: rtl;}
</style>
<table>
    <tr>
        <td width="20%">
            <img src="<?php echo candidateThumb3($resume['image']); ?>" height="70" />
        </td>
        <td width="80%">
            <h2><?php echo esc_output($resume['first_name'].' '.$resume['last_name'], 'html'); ?></h2>
            <p>
                <?php 
                    echo esc_output(($resume['email'] ? $resume['email'] : '') 
                        . ($resume['phone1'] ? ", ".$resume['phone1'] : '')
                        . ($resume['phone2'] ? ", ".$resume['phone2'] : '')
                        . ($resume['address'] ? "<br /> ".$resume['address'] : '')
                        . ($resume['city'] ? ", ".$resume['city'] : '')
                        . ($resume['state'] ? ", ".$resume['state'] : '')
                        . ($resume['country'] ? ", ".$resume['country'] : ''), 'raw')
                    ; ?>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php echo lang('objective'); ?></h2>
            <p><?php echo esc_output($resume['objective'], 'html'); ?></p>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php echo lang('job_experiences'); ?></h2>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php if ($resume['experiences']) { ?>
            <div>
                <ul dir="rtl">
                    <?php foreach ($resume['experiences'] as $experience) { ?>
                    <li>
                        <h3><?php echo esc_output($experience['title'], 'html'); ?> - <?php echo esc_output($experience['company'], 'html'); ?></h3>
                        <p>(<?php echo timeFormat(esc_output($experience['from'], 'html')); ?> - <?php echo timeFormat(esc_output($experience['to'], 'html')); ?>)</p>
                        <p><?php echo esc_output($experience['description'], 'html'); ?></p>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } else { ?>
            <p><?php echo lang('there_are_no_experiences'); ?></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php echo lang('qualifications'); ?></h2>
            <?php if ($resume['qualifications']) { ?>
            <div>
                <ul dir="rtl">
                    <?php foreach ($resume['qualifications'] as $qualification) { ?>
                    <li>
                        <h3><?php echo esc_output($qualification['title'], 'html'); ?> - <?php echo esc_output($qualification['institution'], 'html'); ?></h3>
                        <p>(<?php echo timeFormat(esc_output($qualification['from'], 'html')); ?> - <?php echo timeFormat(esc_output($qualification['to'], 'html')); ?>)</p>
                        <p><?php echo esc_output($qualification['marks'], 'html'); ?> Out of <?php echo esc_output($qualification['out_of'], 'html'); ?></p>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } else { ?>
            <p><?php echo lang('there_are_no_qualifications'); ?></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php echo lang('skills'); ?></h2>
            <?php if ($resume['skills']) { ?>
            <div>
                <ul dir="rtl">
                    <?php foreach ($resume['skills'] as $skill) { ?>
                    <li>
                        <h3><?php echo esc_output($skill['title'], 'html'); ?> (<?php echo esc_output($skill['proficiency'], 'html'); ?>)</h3>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } else { ?>
            <p><?php echo lang('there_are_no_skills'); ?></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php echo lang('languages'); ?></h2>
            <?php if ($resume['languages']) { ?>
            <div>
                <ul dir="rtl">
                    <?php foreach ($resume['languages'] as $language) { ?>
                    <li>
                        <h3><?php echo esc_output($language['title'], 'html'); ?> (<?php echo esc_output($language['proficiency'], 'html'); ?>)</h3>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } else { ?>
            <p><?php echo lang('there_are_no_languages'); ?></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php echo lang('achievements'); ?></h2>
            <?php if ($resume['achievements']) { ?>
            <div>
                <ul dir="rtl">
                    <?php foreach ($resume['achievements'] as $achievement) { ?>
                    <li>
                        <h3><?php echo esc_output($achievement['title'], 'html'); ?> (<?php echo esc_output($achievement['type'], 'html'); ?>)</h3>
                        <?php if ($achievement['date']) { ?>
                        <p>(<?php echo esc_output($achievement['date'], 'html'); ?>)</p>
                        <?php } ?>
                        <?php if ($achievement['link']) { ?>
                        <p>(<?php echo esc_output($achievement['link'], 'html'); ?>)</p>
                        <?php } ?>
                        <p><?php echo esc_output($achievement['description'], 'html'); ?></p>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } else { ?>
            <p><?php echo lang('there_are_no_achievements'); ?></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php echo lang('references'); ?></h2>
            <?php if ($resume['references']) { ?>
            <div>
                <ul dir="rtl">
                    <?php foreach ($resume['references'] as $reference) { ?>
                    <li>
                        <h3><?php echo esc_output($reference['title'], 'html'); ?> (<?php echo esc_output($reference['relation'], 'html'); ?>)</h3>
                        <?php if ($reference['company']) { ?>
                        <p>(<?php echo esc_output($reference['company'], 'html'); ?>)</p>
                        <?php } ?>
                        <?php if ($reference['phone']) { ?>
                        <p>(<?php echo esc_output($reference['phone'], 'html'); ?>)</p>
                        <?php } ?>
                        <p>(<?php echo esc_output($reference['email'], 'html'); ?>)</p>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } else { ?>
            <p><?php echo lang('there_are_no_references'); ?></p>
            <?php } ?>
        </td>
    </tr>
</table>
<hr />
<?php } else { ?>
<?php } ?>