<?php if ($languages) { ?>
<?php 
    $candidate_lang = candidateLanguage() ? candidateLanguage() : defaultLanguage(); 
    $flag = candidateLanguageFlag();
?>
<li class="nav-item dropdown">
    <a class="nav-link flag-dropdown" href="#" data-bs-toggle="dropdown">
        <span class="parent-flag flag-icon flag-icon-<?php echo $flag; ?>" data-parent-flag="flag-icon-<?php echo $flag; ?>"></span> 
        <span class="parent-title"><?php echo esc_output($candidate_lang); ?></span>
        <i class="fas fa-chevron-down"></i>
    </a>
    <ul class="dropdown-menu flag-dropdown-list flag-menu shadow">
        <?php foreach ($languages as $l) { ?>
        <?php 
            $flag = 'flag-icon-'.esc_output($l['flag']);
            $title = esc_output($l['title']);
            if ($l['display'] == 'only_title') {
                $content = '<span class=""></span>'.$title;
            } elseif ($l['display'] == 'only_flag') {
                $content = '<span class="'.$flag.'"></span>';
            } else {
                $content = '<span class="'.$flag.'"></span> '.$title;
            }
            $selected = $l['slug'] == $candidate_lang ? 'selected' : '';
        ?>
        <li>
            <a class="dropdown-item flag-item front-language-selector" 
                href="#" 
                data-direction="<?php echo esc_output($l['direction']); ?>" 
                data-content="<?php echo esc_output($l['slug']); ?>"                
                data-flag="<?php echo $flag; ?>" 
                data-title="<?php echo esc_output($l['slug']); ?>">
                <span class="flag-icon <?php echo $flag; ?>"></span> <span><?php echo esc_output($l['slug']); ?></span>
            </a>
        </li>
        <?php } ?>
    </ul>
</li>
<?php } ?>