<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Admin User(outer) routes
$route['admin'] = 'admin/users/loginView';
$route['admin/login'] = 'admin/users/loginView';
$route['admin/login-post'] = 'admin/users/login';
$route['admin/forgot-password'] = 'admin/users/forgotPasswordView';
$route['admin/forgot-password-post'] = 'admin/users/forgotPassword';
$route['admin/reset-password/(:any)'] = 'admin/users/resetPasswordView/$1';
$route['admin/reset-password-post'] = 'admin/users/resetPassword';

//Admin User(inner) routes
$route['admin/profile'] = 'admin/users/profile';
$route['admin/password'] = 'admin/users/passwordView';
$route['admin/profile-post'] = 'admin/users/updateProfile';
$route['admin/password-post'] = 'admin/users/updatePassword';
$route['admin/logout'] = 'admin/users/logout';

//Admin Users module routes
$route['admin/users'] = 'admin/users/usersListView';
$route['admin/users/data'] = 'admin/users/usersList';
$route['admin/users/create-or-edit'] = 'admin/users/createOrEditUser';
$route['admin/users/create-or-edit/(:any)'] = 'admin/users/createOrEditUser/$1';
$route['admin/users/message-user/(:any)'] = 'admin/users/messageUser/$1';
$route['admin/users/message-user-save'] = 'admin/users/messageUserSave/$1';
$route['admin/users/save'] = 'admin/users/saveUser';
$route['admin/users/save-roles'] = 'admin/users/saveUserRoles';
$route['admin/users/status/(:any)/(:any)'] = 'admin/users/changeStatus/$1/$2';
$route['admin/users/bulk-action'] = 'admin/users/bulkAction';
$route['admin/users/delete/(:any)'] = 'admin/users/delete/$1';

//Adming settings routes
$route['admin/settings/general'] = 'admin/settings/general';
$route['admin/settings/display'] = 'admin/settings/display';
$route['admin/settings/apis'] = 'admin/settings/apis';
$route['admin/settings/css'] = 'admin/settings/css';
$route['admin/settings/languages'] = 'admin/settings/languages';
$route['admin/settings/home'] = 'admin/settings/home';
$route['admin/settings/save'] = 'admin/settings/updateSettings';
$route['admin/settings/update-css'] = 'admin/settings/updateCss';
$route['admin/settings/update-app'] = 'admin/settings/updateHistory';

//Admin Roles module routes
$route['admin/roles'] = 'admin/roles/listView';
$route['admin/role-permissions/(:any)'] = 'admin/roles/getRolePermissions/$1';
$route['admin/roles/save'] = 'admin/roles/saveRole';
$route['admin/roles/delete/(:any)'] = 'admin/roles/delete/$1';
$route['admin/roles/add-permission/(:any)/(:any)'] = 'admin/roles/addPermission/$1/$2';
$route['admin/roles/remove-permission/(:any)/(:any)'] = 'admin/roles/removePermission/$1/$2';
$route['admin/roles/rolesAsSelect2'] = 'admin/roles/rolesAsSelect2';

//Admin Candidates module routes
$route['admin/candidates'] = 'admin/candidates/listView';
$route['admin/candidates/data'] = 'admin/candidates/data';
$route['admin/candidates/create-or-edit'] = 'admin/candidates/createOrEdit';
$route['admin/candidates/create-or-edit/(:any)'] = 'admin/candidates/createOrEdit/$1';
$route['admin/candidates/save'] = 'admin/candidates/saveCandidate';
$route['admin/candidates/status/(:any)/(:any)'] = 'admin/candidates/changeStatus/$1/$2';
$route['admin/candidates/bulk-action'] = 'admin/candidates/bulkAction';
$route['admin/candidates/delete/(:any)'] = 'admin/candidates/delete/$1';
$route['admin/candidates/resume/(:any)'] = 'admin/candidates/resume/$1';
$route['admin/candidates/resume-download'] = 'admin/candidates/resumeDownload';
$route['admin/candidates/excel'] = 'admin/candidates/candidatesExcel';
$route['admin/candidates/message-view'] = 'admin/CandidateInterviews/messageView';
$route['admin/candidates/message'] = 'admin/CandidateInterviews/message';

//Admin Jobs module routes
$route['admin/jobs'] = 'admin/jobs/listView';
$route['admin/jobs/data'] = 'admin/jobs/data';
$route['admin/jobs/create-or-edit'] = 'admin/jobs/createOrEdit/$1';
$route['admin/jobs/create-or-edit/(:any)'] = 'admin/jobs/createOrEdit/$1';
$route['admin/jobs/save'] = 'admin/jobs/save';
$route['admin/jobs/status/(:any)/(:any)'] = 'admin/jobs/changeStatus/$1/$2';
$route['admin/jobs/bulk-action'] = 'admin/jobs/bulkAction';
$route['admin/jobs/delete/(:any)'] = 'admin/jobs/delete/$1';
$route['admin/jobs/excel'] = 'admin/jobs/excel';
$route['admin/jobs/add-custom-field'] = 'admin/jobs/addCustomField';
$route['admin/jobs/remove-custom-field/(:any)'] = 'admin/jobs/removeCustomField/$1';
$route['admin/jobs/apply-for-candidate/(:any)'] = 'admin/jobs/applyForCandidateView/$1';
$route['admin/jobs/apply-for-candidate-resumes/(:any)'] = 'admin/jobs/applyForCandidateResumesList/$1';
$route['admin/jobs/apply-for-candidate-post'] = 'admin/jobs/applyForCandidate';
$route['admin/jobs/import-view'] = 'admin/jobs/importView';
$route['admin/jobs/import'] = 'admin/jobs/import';

//Admin job filter module routes
$route['admin/job-filters'] = 'admin/JobFilters/listView';
$route['admin/job-filters/data'] = 'admin/JobFilters/data';
$route['admin/job-filters/create-or-edit'] = 'admin/JobFilters/createOrEdit/$1';
$route['admin/job-filters/create-or-edit/(:any)'] = 'admin/JobFilters/createOrEdit/$1';
$route['admin/job-filters/save'] = 'admin/JobFilters/save';
$route['admin/job-filters/update-values/(:any)'] = 'admin/JobFilters/updateValuesForm/$1';
$route['admin/job-filters/update-values'] = 'admin/JobFilters/updateValues';
$route['admin/job-filters/new-value'] = 'admin/JobFilters/newValue';
$route['admin/job-filters/status/(:any)/(:any)'] = 'admin/JobFilters/changeStatus/$1/$2';
$route['admin/job-filters/bulk-action'] = 'admin/JobFilters/bulkAction';
$route['admin/job-filters/delete/(:any)'] = 'admin/JobFilters/delete/$1';

//Admin Companies module routes
$route['admin/companies'] = 'admin/companies/listView';
$route['admin/companies/data'] = 'admin/companies/data';
$route['admin/companies/create-or-edit'] = 'admin/companies/createOrEdit/$1';
$route['admin/companies/create-or-edit/(:any)'] = 'admin/companies/createOrEdit/$1';
$route['admin/companies/save'] = 'admin/companies/save';
$route['admin/companies/status/(:any)/(:any)'] = 'admin/companies/changeStatus/$1/$2';
$route['admin/companies/bulk-action'] = 'admin/companies/bulkAction';
$route['admin/companies/delete/(:any)'] = 'admin/companies/delete/$1';

//Admin Languages module routes
$route['admin/languages'] = 'admin/languages/listView';
$route['admin/languages/data'] = 'admin/languages/data';
$route['admin/languages/create-or-edit'] = 'admin/languages/createOrEdit/$1';
$route['admin/languages/create-or-edit/(:any)'] = 'admin/languages/createOrEdit/$1';
$route['admin/languages/edit/(:any)'] = 'admin/languages/edit/$1';
$route['admin/languages/save'] = 'admin/languages/save';
$route['admin/languages/update'] = 'admin/languages/update';
$route['admin/languages/status/(:any)/(:any)'] = 'admin/languages/changeStatus/$1/$2';
$route['admin/languages/selected/(:any)'] = 'admin/languages/changeSelected/$1';
$route['admin/languages/default/(:any)'] = 'admin/languages/changeDefault/$1';
$route['admin/languages/bulk-action'] = 'admin/languages/bulkAction';
$route['admin/languages/delete/(:any)'] = 'admin/languages/delete/$1';
$route['admin/languages/set/(:any)/(:any)'] = 'admin/languages/setLanguage/$1/$2';

//Admin Traits module routes
$route['admin/traits'] = 'admin/traits/listView';
$route['admin/traits/data'] = 'admin/traits/data';
$route['admin/traits/create-or-edit'] = 'admin/traits/createOrEdit/$1';
$route['admin/traits/create-or-edit/(:any)'] = 'admin/traits/createOrEdit/$1';
$route['admin/traits/save'] = 'admin/traits/save';
$route['admin/traits/status/(:any)/(:any)'] = 'admin/traits/changeStatus/$1/$2';
$route['admin/traits/bulk-action'] = 'admin/traits/bulkAction';
$route['admin/traits/delete/(:any)'] = 'admin/traits/delete/$1';

//Admin Departments module routes
$route['admin/departments'] = 'admin/departments/listView';
$route['admin/departments/data'] = 'admin/departments/data';
$route['admin/departments/create-or-edit'] = 'admin/departments/createOrEdit/$1';
$route['admin/departments/create-or-edit/(:any)'] = 'admin/departments/createOrEdit/$1';
$route['admin/departments/save'] = 'admin/departments/save';
$route['admin/departments/status/(:any)/(:any)'] = 'admin/departments/changeStatus/$1/$2';
$route['admin/departments/bulk-action'] = 'admin/departments/bulkAction';
$route['admin/departments/delete/(:any)'] = 'admin/departments/delete/$1';

//Admin Question Categories module routes
$route['admin/question-categories'] = 'admin/QuestionCategories/listView';
$route['admin/question-categories/data'] = 'admin/QuestionCategories/data';
$route['admin/question-categories/create-or-edit'] = 'admin/QuestionCategories/createOrEdit/$1';
$route['admin/question-categories/create-or-edit/(:any)'] = 'admin/QuestionCategories/createOrEdit/$1';
$route['admin/question-categories/save'] = 'admin/QuestionCategories/save';
$route['admin/question-categories/status/(:any)/(:any)'] = 'admin/QuestionCategories/changeStatus/$1/$2';
$route['admin/question-categories/bulk-action'] = 'admin/QuestionCategories/bulkAction';
$route['admin/question-categories/delete/(:any)'] = 'admin/QuestionCategories/delete/$1';

//Admin Questions Bank routes
$route['admin/questions/create-or-edit'] = 'admin/questions/createOrEdit/$1';
$route['admin/questions/create-or-edit/(:any)'] = 'admin/questions/createOrEdit/$1';
$route['admin/questions/create-or-edit/(:any)/(:any)'] = 'admin/questions/createOrEdit/$1/$2';
$route['admin/questions/save'] = 'admin/questions/save';
$route['admin/questions/delete/(:any)'] = 'admin/questions/delete/$1';
$route['admin/questions/add-answer/(:any)'] = 'admin/questions/addAnswer/$1';
$route['admin/questions/add-answer/(:any)/(:any)'] = 'admin/questions/addAnswer/$1/$2';
$route['admin/questions/remove-answer/(:any)'] = 'admin/questions/removeAnswer/$1';
$route['admin/questions/remove-image/(:any)'] = 'admin/questions/removeImage/$1';
$route['admin/questions/(:any)'] = 'admin/questions/index/$1';

//Admin Quiz Categories module routes
$route['admin/quiz-categories'] = 'admin/QuizCategories/listView';
$route['admin/quiz-categories/data'] = 'admin/QuizCategories/data';
$route['admin/quiz-categories/create-or-edit'] = 'admin/QuizCategories/createOrEdit/$1';
$route['admin/quiz-categories/create-or-edit/(:any)'] = 'admin/QuizCategories/createOrEdit/$1';
$route['admin/quiz-categories/save'] = 'admin/QuizCategories/save';
$route['admin/quiz-categories/status/(:any)/(:any)'] = 'admin/QuizCategories/changeStatus/$1/$2';
$route['admin/quiz-categories/bulk-action'] = 'admin/QuizCategories/bulkAction';
$route['admin/quiz-categories/delete/(:any)'] = 'admin/QuizCategories/delete/$1';

//Admin Quiz routes
$route['admin/quizes/create-or-edit'] = 'admin/quizes/createOrEdit/$1';
$route['admin/quizes/create-or-edit/(:any)'] = 'admin/quizes/createOrEdit/$1';
$route['admin/quizes/save'] = 'admin/quizes/save';
$route['admin/quizes/clone'] = 'admin/quizes/cloneQuiz';
$route['admin/quizes/clone/(:any)'] = 'admin/quizes/cloneForm/$1';
$route['admin/quizes/delete/(:any)'] = 'admin/quizes/delete/$1';
$route['admin/quizes/dropdown/(:any)'] = 'admin/quizes/dropdown/$1';
$route['admin/quizes/download/(:any)'] = 'admin/quizes/download/$1';

//Admin Quiz Questions routes
$route['admin/quiz-questions/add/(:any)/(:any)'] = 'admin/QuizQuestions/add/$1/$2';
$route['admin/quiz-questions/edit/(:any)'] = 'admin/QuizQuestions/edit/$1';
$route['admin/quiz-questions/delete/(:any)'] = 'admin/QuizQuestions/delete/$1';
$route['admin/quiz-questions/order'] = 'admin/QuizQuestions/order';
$route['admin/quiz-questions/add-answer/(:any)/(:any)'] = 'admin/QuizQuestions/addAnswer/$1/$2';
$route['admin/quiz-questions/remove-answer/(:any)'] = 'admin/QuizQuestions/removeAnswer/$1';
$route['admin/quiz-questions/save'] = 'admin/QuizQuestions/save';
$route['admin/quiz-questions/remove-image/(:any)'] = 'admin/QuizQuestions/removeImage/$1';
$route['admin/quiz-questions/(:any)'] = 'admin/QuizQuestions/index/$1';

//Admin Interview Categories module routes
$route['admin/interview-categories'] = 'admin/InterviewCategories/listView';
$route['admin/interview-categories/data'] = 'admin/InterviewCategories/data';
$route['admin/interview-categories/create-or-edit'] = 'admin/InterviewCategories/createOrEdit/$1';
$route['admin/interview-categories/create-or-edit/(:any)'] = 'admin/InterviewCategories/createOrEdit/$1';
$route['admin/interview-categories/save'] = 'admin/InterviewCategories/save';
$route['admin/interview-categories/status/(:any)/(:any)'] = 'admin/InterviewCategories/changeStatus/$1/$2';
$route['admin/interview-categories/bulk-action'] = 'admin/InterviewCategories/bulkAction';
$route['admin/interview-categories/delete/(:any)'] = 'admin/InterviewCategories/delete/$1';

//Admin Interview routes
$route['admin/interviews/create-or-edit'] = 'admin/interviews/createOrEdit/$1';
$route['admin/interviews/create-or-edit/(:any)'] = 'admin/interviews/createOrEdit/$1';
$route['admin/interviews/save'] = 'admin/interviews/save';
$route['admin/interviews/clone'] = 'admin/interviews/cloneInterview';
$route['admin/interviews/clone/(:any)'] = 'admin/interviews/cloneForm/$1';
$route['admin/interviews/delete/(:any)'] = 'admin/interviews/delete/$1';
$route['admin/interviews/dropdown/(:any)'] = 'admin/interviews/dropdown/$1';
$route['admin/interviews/download/(:any)'] = 'admin/interviews/download/$1';

//Admin Interview Questions routes
$route['admin/interview-questions/add/(:any)/(:any)'] = 'admin/InterviewQuestions/add/$1/$2';
$route['admin/interview-questions/edit/(:any)'] = 'admin/InterviewQuestions/edit/$1';
$route['admin/interview-questions/delete/(:any)'] = 'admin/InterviewQuestions/delete/$1';
$route['admin/interview-questions/order'] = 'admin/InterviewQuestions/order';
$route['admin/interview-questions/add-answer/(:any)/(:any)'] = 'admin/InterviewQuestions/addAnswer/$1/$2';
$route['admin/interview-questions/remove-answer/(:any)'] = 'admin/InterviewQuestions/removeAnswer/$1';
$route['admin/interview-questions/save'] = 'admin/InterviewQuestions/save';
$route['admin/interview-questions/(:any)'] = 'admin/InterviewQuestions/index/$1';

//Admin Candidate Interviews module routes
$route['admin/candidate-interviews'] = 'admin/CandidateInterviews/listView';
$route['admin/candidate-interviews/data'] = 'admin/CandidateInterviews/data';
$route['admin/candidate-interviews/view-or-conduct/(:any)'] = 'admin/CandidateInterviews/viewOrConduct/$1';
$route['admin/candidate-interviews/save'] = 'admin/CandidateInterviews/save';

//Admin Quiz Designer Page route
$route['admin/quiz-designer'] = 'admin/QuizDesigner/index';

//Admin Interview Designer Page route
$route['admin/interview-designer'] = 'admin/InterviewDesigner/index';

//Admin Job Board routes
$route['admin/job-board'] = 'admin/JobBoard/index';
$route['admin/job-board/jobs-list'] = 'admin/JobBoard/jobsList';
$route['admin/job-board/candidates-list/(:any)'] = 'admin/JobBoard/candidatesList/$1';
$route['admin/job-board/assign-view/(:any)/(:any)'] = 'admin/JobBoard/assignView/$1/$2';
$route['admin/job-board/assign'] = 'admin/JobBoard/assign';
$route['admin/job-board/delete-interview/(:any)'] = 'admin/JobBoard/deleteInterview/$1';
$route['admin/job-board/delete-quiz/(:any)'] = 'admin/JobBoard/deleteQuiz/$1';
$route['admin/job-board/candidate-status'] = 'admin/JobBoard/candidateStatus';
$route['admin/job-board/delete-app'] = 'admin/JobBoard/deleteApplication';
$route['admin/job-board/edit-overall-result/(:any)'] = 'admin/JobBoard/editOverallResult/$1';
$route['admin/job-board/save-overall-result'] = 'admin/JobBoard/saveOverallResult';
$route['admin/job-board/job/(:any)'] = 'admin/JobBoard/viewJob/$1';
$route['admin/job-board/resume/(:any)'] = 'admin/JobBoard/viewResume/$1';
$route['admin/job-board/overall-result'] = 'admin/JobBoard/overallResult';
$route['admin/job-board/pdf-result'] = 'admin/JobBoard/pdfResult';
$route['admin/job-board/(:any)'] = 'admin/JobBoard/index/$1';

//Admin Dashboard Routes
$route['admin/dashboard'] = 'admin/dashboard/index';
$route['admin/dashboard/popular-jobs-data'] = 'admin/dashboard/popularJobsChartData';
$route['admin/dashboard/top-candidates-data'] = 'admin/dashboard/topCandidatesChartData';
$route['admin/dashboard/jobs-list'] = 'admin/dashboard/jobsList';

//Admin Dashboard todos Routes
$route['admin/todos/list'] = 'admin/todos/listView';
$route['admin/todos/create-or-edit'] = 'admin/todos/createOrEditToDo';
$route['admin/todos/create-or-edit/(:any)'] = 'admin/todos/createOrEditToDo/$1';
$route['admin/todos/save'] = 'admin/todos/save';
$route['admin/todos/delete/(:any)'] = 'admin/todos/delete/$1';
$route['admin/todo/(:any)/(:any)'] = 'admin/todos/todoStatus/$1/$2';

//Admin Blog Categories module routes
$route['admin/blog-categories'] = 'admin/BlogCategories/listView';
$route['admin/blog-categories/data'] = 'admin/BlogCategories/data';
$route['admin/blog-categories/create-or-edit'] = 'admin/BlogCategories/createOrEdit/$1';
$route['admin/blog-categories/create-or-edit/(:any)'] = 'admin/BlogCategories/createOrEdit/$1';
$route['admin/blog-categories/save'] = 'admin/BlogCategories/save';
$route['admin/blog-categories/status/(:any)/(:any)'] = 'admin/BlogCategories/changeStatus/$1/$2';
$route['admin/blog-categories/bulk-action'] = 'admin/BlogCategories/bulkAction';
$route['admin/blog-categories/delete/(:any)'] = 'admin/BlogCategories/delete/$1';

//Admin Blog module routes
$route['admin/blogs'] = 'admin/blogs/listView';
$route['admin/blogs/data'] = 'admin/blogs/data';
$route['admin/blogs/create-or-edit'] = 'admin/blogs/createOrEdit/$1';
$route['admin/blogs/create-or-edit/(:any)'] = 'admin/blogs/createOrEdit/$1';
$route['admin/blogs/save'] = 'admin/blogs/save';
$route['admin/blogs/status/(:any)/(:any)'] = 'admin/blogs/changeStatus/$1/$2';
$route['admin/blogs/bulk-action'] = 'admin/blogs/bulkAction';
$route['admin/blogs/delete/(:any)'] = 'admin/blogs/delete/$1';

//Admin General routes
$route['admin/ckeditor/images/upload'] = 'admin/blogs/uploadCkEditorImages';
$route['admin/sidebar-toggle'] = 'pages/sidebarToggle';

//Admin Footer section modue
$route['admin/footer-sections'] = 'admin/FooterSections/index';
$route['admin/footer-sections/save'] = 'admin/FooterSections/save';

//Candidate Routes (outer)
$route['login'] = 'candidates/loginView';
$route['post-login'] = 'candidates/login';
$route['logout'] = 'candidates/logout';
$route['register'] = 'candidates/registerView';
$route['post-register'] = 'candidates/register';
$route['forgot-password'] = 'candidates/showForgotPassword';
$route['send-password-link'] = 'candidates/sendPasswordLink';
$route['reset-password/(:any)'] = 'candidates/resetPassword/$1';
$route['reset-password'] = 'candidates/updatePasswordByForgot';
$route['activate-account/(:any)'] = 'candidates/activateAccount/$1';
$route['google-redirect'] = 'candidates/googleRedirect';
$route['linkedin-redirect'] = 'candidates/linkedinRedirect';
$route['admin-login/(:any)/(:any)'] = 'candidates/adminLogin/$1/$2';

//Candidate Routes (inner)
$route['account/profile'] = 'candidates/updateProfileView';
$route['profile-update'] = 'candidates/updateProfile';
$route['account/password'] = 'candidates/updatePasswordView';
$route['password-update'] = 'candidates/updatePassword';

//Account area Candidate Resumes Routes (inner)
$route['account'] = 'resumes/listing';
$route['create-resume'] = 'resumes/create';
$route['account/resume/(:any)'] = 'resumes/detailView/$1';
$route['account/resume-save-general'] = 'resumes/updateGeneral';
$route['account/resume-save-experience'] = 'resumes/updateExperience';
$route['account/resume-save-qualification'] = 'resumes/updateQualification';
$route['account/resume-save-skill'] = 'resumes/updateSkill';
$route['account/resume-save-language'] = 'resumes/updateLanguage';
$route['account/resume-save-achievement'] = 'resumes/updateAchievement';
$route['account/resume-save-reference'] = 'resumes/updateReference';
$route['account/resume-add-section/(:any)/(:any)'] = 'resumes/addSection/$1/$2';
$route['account/resume-remove-section/(:any)/(:any)'] = 'resumes/removeSection/$1/$2';
$route['account/resume-update-doc'] = 'resumes/updateDocResume';

//Account ares job routes
$route['account/job-applications'] = 'jobs/jobApplicationsView';
$route['account/job-applications/(:any)'] = 'jobs/jobApplicationsView/$1';
$route['account/job-favorites'] = 'jobs/jobFavoritesView';
$route['account/job-favorites/(:any)'] = 'jobs/jobFavoritesView/$1';
$route['account/job-referred'] = 'jobs/jobReferredView';
$route['account/job-referred/(:any)'] = 'jobs/jobReferredView/$1';

//Account Area Quizes routes
$route['account/quizes'] = 'quizes/listView';
$route['account/quizes/(:any)'] = 'quizes/listView/$1';
$route['account/quiz/(:any)'] = 'quizes/attemptView/$1';
$route['account/quiz-attempt'] = 'quizes/attempt';
$route['account/interviews'] = 'candidates/interviewsView';
$route['account/interviews/(:any)'] = 'candidates/interviewsView/$1';

//Front end routes
$route['jobs'] = 'jobs/listing';
$route['jobs/(:any)'] = 'jobs/listing/$1';
$route['job/(:any)'] = 'jobs/detail/$1';
$route['mark-favorite/(:any)'] = 'jobs/markFavorite/$1';
$route['unmark-favorite/(:any)'] = 'jobs/unmarkFavorite/$1';
$route['refer-job-view'] = 'jobs/referJobView';
$route['refer-job'] = 'jobs/referJob';
$route['apply-job'] = 'jobs/applyJob';
$route['blogs'] = 'pages/blogListing';
$route['blogs/(:any)'] = 'pages/blogListing/$1';
$route['blog/(:any)'] = 'pages/blogDetail/$1';
$route['setlanguage/(:any)/(:any)'] = 'pages/setLanguage/$1/$2';
$route['setcolor/(:any)'] = 'pages/setColor/$1/$2';

//Installation and other routes
$route['admin-user'] = 'admin/users/createAdminUser';
$route['encrypt-files'] = 'admin/settings/encryptFiles';
$route['schema'] = 'schema/run';
$route['import-data'] = 'schema/data';
$route['complete-install'] = 'pages/createSchemaAndImportData';
$route['schema-import'] = 'admin/settings/runSchemaAndImportData';
$route['default_controller'] = 'pages/index';
$route['404_override'] = 'pages/notFoundPage';
$route['translate_uri_dashes'] = FALSE;

