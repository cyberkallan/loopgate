<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
$my_course_url = strtolower($this->session->userdata('role')) == 'user' ? site_url('home/my_courses') : 'javascript::';
$course_details_url = site_url("home/course/".slugify($course_details['title'])."/".$course_id);
?>
<div class="container-fluid course_container">
    <!-- Top bar -->
    <div class="row">
        <div class="col-lg-9 course_header_col">
            <h5>
                <img src="<?php echo base_url().'uploads/system/logo-light-sm.png';?>" height="25"> |
                <?php echo $course_details['title']; ?>
            </h5>
        </div>
        <div class="col-lg-3 course_header_col">
            <a href="javascript::" class="course_btn" onclick="toggle_lesson_view()"><i class="fa fa-arrows-alt-h"></i></a>
            <a href="<?php echo $my_course_url; ?>" class="course_btn"> <i class="fa fa-chevron-left"></i> <?php echo get_phrase('my_courses'); ?></a>
            <a href="<?php echo $course_details_url; ?>" class="course_btn"><?php echo get_phrase('course_details'); ?> <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>

    <div class="row" id = "lesson-container">
        <?php if (isset($lesson_id)): ?>
            <!-- Course content, video, quizes, files starts-->
            <?php include 'course_content_body.php'; ?>
            <!-- Course content, video, quizes, files ends-->
        <?php endif; ?>

        <!-- Course sections and lesson selector sidebar starts-->
        <?php include 'course_content_sidebar.php'; ?>
        <!-- Course sections and lesson selector sidebar ends-->
    </div>

    
    <div class="row my-4">
        <div class="col-lg-9">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <ul class="nav nav-tabs <?php if(!addon_status('forum')) echo 'border-0'; ?>">
                        <?php if(addon_status('forum')): ?>
                            <li class="nav-item">
                                <a class="nav-link remove-active active" id="qAndA" onclick="load_questions('<?= $course_id; ?>')" href="javascript:;"><?= site_phrase('forum'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!--load body with ajax for any addon. First load course forum addon if exits or elseif-->
                <div class="col-md-12 p-4" id="load-tabs-body">
                    <?php if(addon_status('forum')): ?>
                        <?php include 'course_forum.php'; ?>
                    <?php endif; ?>
                </div>
                <?php if(addon_status('forum')): ?>
                    <?php include 'course_forum_scripts.php'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
