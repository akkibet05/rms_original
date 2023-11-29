<?php

class SchemaModel extends CI_Model
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function run()
    {
        $this->createUsersTable();
        $this->createRolesTable();
        $this->createPermissionsTable();
        $this->createRolePermissionsTable();
        $this->createUserRolesTable();
        $this->createCandidatesTable();
        $this->createResumeTable();
        $this->addColumnToResumeTable();
        $this->addColumnToResumeTableOnePointNine();
        $this->createResumeExperienceTable();
        $this->createResumeSkillTable();
        $this->createResumeLanguageTable();
        $this->createResumeQualificationTable();
        $this->createResumeAchievementsTable();
        $this->createResumeReferencesTable();
        $this->createJobsTable();
        $this->addColumnsToJobTable();
        $this->createJobFiltersTable();
        $this->addColumnToJobFiltersTable();
        $this->createJobFilterValuesTable();
        $this->createJobFilterValueAssignmentsTable();
        $this->createJobsCustomFieldsTable();
        $this->createDepartmentsTable();
        $this->createCompaniesTable();
        $this->createTraitsTable();
        $this->createJobTraitsTable();
        $this->createJobTraitAnswersTable();
        $this->createJobApplicationsTable();
        $this->createJobFavoritesTable();
        $this->createJobReferredTable();
        $this->createBlogCategoriesTable();
        $this->createBlogsTable();
        $this->addColumnsToBlogsTable();        
        $this->createFooterSectionsTable();
        $this->createSettingsTable();
        $this->createToDosTable();
        $this->createLanguagesTable();
        $this->addColumnsToLanguagesTable();
        $this->createAppUpdateTable();

        $this->importSettings();
        $this->importUpdate();        
        $this->importFooterSections();
        $this->importPermissionsData();
        $this->importLanguagesData();
    }

    private function createUsersTable()
    {
        $fields = array(
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'first_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'last_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'username' => array('type' => 'VARCHAR', 'constraint' => '100', 'unique' => TRUE,),
            'email' => array('type' => 'VARCHAR', 'constraint' => '150', 'unique' => TRUE,),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'password' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'status' => array('type' => 'TINYINT',),
            'token' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'user_type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'admin',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('users', $fields, 'user_id');
    }

    private function createCandidatesTable()
    {
        $fields = array(
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'first_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'last_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '150', 'unique' => TRUE,),
            'password' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'phone1' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'phone2' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'city' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'state' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'country' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'address' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'gender' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'dob' => array('type' => 'DATETIME', 'null' => TRUE,),
            'bio' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'account_type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'site', 'null' => TRUE,),
            'external_id' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE,),
            'token' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('candidates', $fields, 'candidate_id');
    }

    private function createResumeTable()
    {
        $fields = array(
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'designation' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'objective' => array('type' => 'TEXT',),
            'status' => array('type' => 'TINYINT',),
            'type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'detailed', 'null' => TRUE,),
            'file' => array('type' => 'VARCHAR', 'constraint' => '200',),
            'experience' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'experiences' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'qualifications' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'languages' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'achievements' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'references' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'is_default' => array('type' => 'TINYINT', 'default' => 1),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resumes', $fields, 'resume_id');
    }

    private function addColumnToResumeTable()
    {
        if ($this->db->table_exists('resumes')) {
            if (!$this->db->field_exists('is_default', 'resumes')) {
                $field = array('is_default' => array('type' => 'TINYINT', 'default' => 1, 'after' => 'references'));
                $this->dbforge->add_column('resumes', $field);
            }
        }
    }

    private function addColumnToResumeTableOnePointNine()
    {
        if ($this->db->table_exists('resumes')) {
            if (!$this->db->field_exists('experiences_all', 'resumes')) {
                $field = array('experiences_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'experiences'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('qualifications_all', 'resumes')) {
                $field = array('qualifications_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'qualifications'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('skills', 'resumes')) {
                $field = array('skills' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'qualifications_all'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('skills_all', 'resumes')) {
                $field = array('skills_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'skills'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('languages_all', 'resumes')) {
                $field = array('languages_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'languages'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('achievements_all', 'resumes')) {
                $field = array('achievements_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'achievements'));
                $this->dbforge->add_column('resumes', $field);
            }
            if (!$this->db->field_exists('references_all', 'resumes')) {
                $field = array('references_all' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE, 'after' => 'references'));
                $this->dbforge->add_column('resumes', $field);
            }
        }
    }    

    private function createResumeExperienceTable()
    {
        $fields = array(
            'resume_experience_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'company' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'from' => array('type' => 'DATETIME', 'null' => TRUE,),
            'to' => array('type' => 'DATETIME', 'null' => TRUE,),
            'description' => array('type' => 'TEXT',),
            'is_current' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_experiences', $fields, 'resume_experience_id');
    }

    private function createResumeSkillTable()
    {
        //Version 1.9
        $fields = array(
            'resume_skill_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'proficiency' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_skills', $fields, 'resume_skill_id');
    }

    private function createResumeLanguageTable()
    {
        $fields = array(
            'resume_language_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'proficiency' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_languages', $fields, 'resume_language_id');
    }

    private function createResumeQualificationTable()
    {
        $fields = array(
            'resume_qualification_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'institution' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'marks' => array('type' => 'DOUBLE',),
            'out_of' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'from' => array('type' => 'DATETIME', 'null' => TRUE,),
            'to' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_qualifications', $fields, 'resume_qualification_id');
    }

    private function createResumeAchievementsTable()
    {
        $fields = array(
            'resume_achievement_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'link' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'date' => array('type' => 'DATETIME', 'null' => TRUE,),
            'type' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_achievements', $fields, 'resume_achievement_id');
    }

    private function createResumeReferencesTable()
    {
        $fields = array(
            'resume_reference_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'relation' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'company' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_references', $fields, 'resume_reference_id');
    }

    private function createRolesTable()
    {
        $fields = array(
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('roles', $fields, 'role_id');
    }

    private function createPermissionsTable()
    {
        $fields = array(
            'permission_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'category' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '100',),
        );
        $this->createTable('permissions', $fields, 'permission_id');
    }

    private function createRolePermissionsTable()
    {
        $fields = array(
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'permission_id' => array('type' => 'INT', 'unsigned' => TRUE,),
        );
        $this->createTable('role_permissions', $fields);
    }

    private function createUserRolesTable()
    {
        $fields = array(
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE,),
        );
        $this->createTable('user_roles', $fields);
    }

    private function createPagesTable()
    {
        $fields = array(
            'page_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'default' => 0,),
            'sidebar_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'sidebar_alignment' => array('type' => 'ENUM("left","right")', 'default' => 'right',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'description' => array('type' => 'TEXT',),
            'keywords' => array('type' => 'TEXT',),
            'summary' => array('type' => 'TEXT',),
            'status' => array('type' => 'TINYINT',),
            'is_default' => array('type' => 'TINYINT',),
            'is_home' => array('type' => 'TINYINT',),
            'order' => array('type' => 'TINYINT', 'default' => 0,),
            'is_menu_enabled' => array('type' => 'TINYINT', 'default' => 1,),
            'parent_id' => array('type' => 'INT', 'default' => 0,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('pages', $fields, 'page_id');
    }

    private function createFooterSectionsTable()
    {
        $fields = array(
            'footer_section_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'content' => array('type' => 'TEXT',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('footer_sections', $fields, 'footer_section_id');
    }    

    private function createSettingsTable()
    {
        $fields = array(
            'setting_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'type' => array('type' => 'VARCHAR', 'constraint' => '80', 'null' => TRUE,),
            'category' => array('type' => 'VARCHAR', 'constraint' => '80', 'null' => TRUE,),
            'description' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'key' => array('type' => 'VARCHAR', 'constraint' => '250',),
            //'value' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
            'value' => array('type' => 'TEXT', 'null' => TRUE,),
            'options' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
        );
        $this->createTable('settings', $fields, 'setting_id');
    }

    private function createToDosTable()
    {
        $fields = array(
            'to_do_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('to_dos', $fields, 'to_do_id');
    }

    private function createJobsTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'company_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'department_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'is_static_allowed' => array('type' => 'TINYINT', 'default' => '0',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('jobs', $fields, 'job_id');
    }

    private function addColumnsToJobTable()
    {
        //Added in Version 1.8
        if ($this->db->table_exists('jobs')) {
            if (!$this->db->field_exists('slug', 'jobs')) {
                $field = array('slug' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE, 'after' => 'title'));
                $this->dbforge->add_column('jobs', $field);

                //Adding slugs for existing jobs
                $jobs = $this->AdminJobModel->getAll(false);
                foreach ($jobs as $j) {
                    $d['slug'] = $this->AdminJobModel->getSlug($j['title'], '', encode($j['job_id']));
                    $this->db->where('jobs.job_id', $j['job_id']);
                    $this->db->update('jobs', $d);
                }
            }
            if (!$this->db->field_exists('meta_keywords', 'jobs')) {
                $field = array('meta_keywords' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'description'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('meta_description', 'jobs')) {
                $field = array('meta_description' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'meta_keywords'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('min_salary', 'jobs')) {
                $field = array('min_salary' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE, 'after' => 'meta_description'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('max_salary', 'jobs')) {
                $field = array('max_salary' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE, 'after' => 'min_salary'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('created_by', 'jobs')) {
                $field = array('created_by' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'after' => 'min_salary'));
                $this->dbforge->add_column('jobs', $field);
            }

            //Added in 2.2
            if (!$this->db->field_exists('number_of_positions', 'jobs')) {
                $field = array('number_of_positions' => array('type' => 'TINYINT', 'null' => TRUE, 'after' => 'created_by'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('expiry_date', 'jobs')) {
                $field = array('expiry_date' => array('type' => 'DATE', 'null' => TRUE, 'after' => 'number_of_positions'));
                $this->dbforge->add_column('jobs', $field);
            }
            if (!$this->db->field_exists('published_at', 'jobs')) {
                $field = array('published_at' => array('type' => 'DATE', 'null' => TRUE, 'after' => 'expiry_date'));
                $this->dbforge->add_column('jobs', $field);
            }            
        }
    }    

    private function createJobFiltersTable()
    {
        $fields = array(
            'job_filter_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'order' => array('type' => 'TINYINT',),
            'admin_filter' => array('type' => 'TINYINT', 'default' => '1',),
            'front_filter' => array('type' => 'TINYINT', 'default' => '1',),
            'front_value' => array('type' => 'TINYINT', 'default' => '1',),
            'type' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_filters', $fields, 'job_filter_id');
    }

    private function addColumnToJobFiltersTable()
    {
        if ($this->db->table_exists('job_filters')) {
            if (!$this->db->field_exists('front_home_filter', 'job_filters')) {
                $field = array('front_home_filter' => array('type' => 'TINYINT', 'default' => 0, 'after' => 'front_filter'));
                $this->dbforge->add_column('job_filters', $field);
            }
        }
    }    

    private function createJobFilterValuesTable()
    {
        $fields = array(
            'job_filter_value_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_filter_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
        );
        $this->createTable('job_filter_values', $fields, 'job_filter_value_id');
    }

    private function createJobFilterValueAssignmentsTable()
    {
        $fields = array(
            'job_filter_value_assignment_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_filter_value_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_filter_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
        );
        $this->createTable('job_filter_value_assignments', $fields, 'job_filter_value_assignment_id');
    }

    private function createJobsCustomFieldsTable()
    {
        $fields = array(
            'custom_field_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'label' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'value' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_custom_fields', $fields, 'custom_field_id');
    }

    private function createDepartmentsTable()
    {
        $fields = array(
            'department_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('departments', $fields, 'department_id');
    }

    private function createCompaniesTable()
    {
        $fields = array(
            'company_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('companies', $fields, 'company_id');
    }

    private function createTraitsTable()
    {
        $fields = array(
            'trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('traits', $fields, 'trait_id');
    }

    private function createJobTraitsTable()
    {
        $fields = array(
            'job_trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_traits', $fields, 'job_trait_id');
    }

    private function createJobTraitAnswersTable()
    {
        $fields = array(
            'job_trait_answer_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_trait_title' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => TRUE),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_application_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'rating' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_trait_answers', $fields, 'job_trait_answer_id');
    }

    private function createJobApplicationsTable()
    {
        $fields = array(
            'job_application_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'status' => array('type' => 'ENUM("applied","shortlisted","interviewed","hired","rejected")', 'default' => 'applied',),            
            'traits_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'quizes_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'interviews_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'overall_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_applications', $fields, 'job_application_id');
    }

    private function createJobFavoritesTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_favorites', $fields);
    }

    private function createJobReferredTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'email' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'name' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_referred', $fields);
    }

    private function createBlogCategoriesTable()
    {
        $fields = array(
            'blog_category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('blog_categories', $fields, 'blog_category_id');
    }

    private function createBlogsTable()
    {
        $fields = array(
            'blog_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'blog_category_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'TEXT',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('blogs', $fields, 'blog_id');
    }    

    private function addColumnsToBlogsTable()
    {
        if ($this->db->table_exists('blogs')) {
            if (!$this->db->field_exists('image', 'blogs')) {
                $field = array('image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE, 'after' => 'description', 'default' => ''));
                $this->dbforge->add_column('blogs', $field);
            }            
        }
    }

    private function createLanguagesTable()
    {
        $fields = array(
            'language_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT',),
            'is_selected' => array('type' => 'TINYINT',),
            'is_default' => array('type' => 'TINYINT', 'default' => '0',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('languages', $fields, 'language_id');
    }

    private function addColumnsToLanguagesTable()
    {
        if ($this->db->table_exists('languages')) {
            if (!$this->db->field_exists('direction', 'languages')) {
                $field = array('direction' => array('type' => 'VARCHAR', 'constraint' => '15', 'null' => TRUE, 'after' => 'is_default', 'default' => 'rtl'));
                $this->dbforge->add_column('languages', $field);
            }
            if (!$this->db->field_exists('display', 'languages')) {
                $field = array('display' => array('type' => 'VARCHAR', 'constraint' => '15', 'null' => TRUE, 'after' => 'direction', 'default' => 'both'));
                $this->dbforge->add_column('languages', $field);
            }
            if (!$this->db->field_exists('flag', 'languages')) {
                $field = array('flag' => array('type' => 'VARCHAR', 'constraint' => '15', 'null' => TRUE, 'after' => 'display', 'default' => 'us'));
                $this->dbforge->add_column('languages', $field);
            }
            if (!$this->db->field_exists('is_main', 'languages')) {
                $field = array('is_main' => array('type' => 'TINYINT', 'default' => 0, 'after' => 'status'));
                $this->dbforge->add_column('languages', $field);
            }            
        }
    }    

    private function createAppUpdateTable()
    {
        $fields = array(
            'update_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'version' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'details' => array('type' => 'TEXT', 'null' => TRUE,),
            'files' => array('type' => 'TEXT', 'null' => TRUE,),
            'is_current' => array('type' => 'TINYINT', 'default' => '0',),
            'released_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('updates', $fields, 'update_id');
    }

    private function createTable($table, $fields, $key = null)
    {
        $this->dbforge->add_field($fields);
        if ($key) {
            $this->dbforge->add_key($key, TRUE);
        }
        $this->dbforge->create_table($table, TRUE);
    }

    public function importSettings()
    {
        $googleTut = '<a href="https://code.tutsplus.com/tutorials/create-a-google-login-page-in-php--cms-33214" target="_blank">Google Login</a>';
        $linkedinTut = '<a href="https://www.linkedin.com/developers/login" target="_blank">Linkedin Login</a>';
        $smtpTutorial = '<a href="#">Email Settings</a>';
        $bannerText = '<h2>Looking for an exciting career path ?<br>Come, Join Us!</h2>';
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'candidatefinder.com';
        $host = str_replace('www.', '', $host);
        $fromEmail = 'hr@'.$host;

        $data = array(

            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'default-landing-page', 'value' => 'home', 'description' => 'Default landing page', 'options' => '["home", "jobs", "news"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'home-banner', 'value' => 'yes', 'description' => 'Display home page banner', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'how-it-works', 'value' => 'yes', 'description' => 'Enable How it works section', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'department-section', 'value' => 'yes', 'description' => 'Enable Department Section', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'news-section', 'value' => 'yes', 'description' => 'Enable News Section', 'options' => '["yes", "no"]'),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'banner-text', 
                'value' => $bannerText, 'description' => 'Banner Text', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'before-how', 'value' => '', 
                'description' => 'Text Before How It Works Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'after-how', 'value' => '', 
                'description' => 'Text After How It Works Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'before-news', 'value' => '', 
                'description' => 'Text Before News Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'after-news', 'value' => '', 
                'description' => 'Text After News Section', 'options' => ''),

            array('type' => 'image', 'user_id' => 0, 'category' => 'Display', 'key' => 'site-logo', 'value' => 'site-logo.png', 'description' => 'Select site logo'),
            array('type' => 'image', 'user_id' => 0, 'category' => 'Display', 'key' => 'site-banner-image', 'value' => '', 'description' => 'Select home page banner'),
            array('type' => 'image', 'user_id' => 0, 'category' => 'Display', 'key' => 'site-favicon', 'value' => 'site-favicon.png', 'description' => 'Select favicon'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'body-bg', 'value' => '#FBFBFB', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'main-menu-bg', 'value' => '#FBFBFB', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'main-banner-bg', 'value' => '#FBFBFB', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'main-banner-height', 'value' => '500px', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'breadcrumb-image', 'value' => 'site-banner-image.jpg', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'main-banner', 'value' => 'site-banner-image.jpg', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'display-front-color-theme', 'value' => 'yes', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'default-front-color-theme', 'value' => 'blue', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'display-front-color-theme-selector-panel', 'value' => 'yes', 'description' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Display', 'key' => 'enable-front-dark-mode-button', 'value' => 'yes', 'description' => ''),

            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'site-name', 'value' => 'Candidate Finder', 'description' => 'Define site name', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'admin-email', 'value' => 'admin@example.com', 'description' => 'Define admin email', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'from-email', 'value' => $fromEmail, 'description' => 'Define from email for mail send', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'purchase-code', 'value' => 'test', 'description' => 'Enter purchase code', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'upload-limit', 'value' => '2', 'description' => 'Enter Upload Limit', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'General', 'key' => 'site-keywords', 'value' => 'candidate finder', 'description' => 'Define Site Keywords', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'General', 'key' => 'site-description', 'value' => 'candidate finder', 'description' => 'Define Site Description', 'options' => ''),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'jobs-limit', 'value' => '10', 'description' => 'No of jobs to display per page', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'blogs-limit', 'value' => '10', 'description' => 'No of blogs to display per page', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'charts-limit', 'value' => '5', 'description' => 'Chart elements count on Dashboard', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-email-verification', 'value' => 'yes', 'description' => 'Enable email verification on register.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-forgot-password', 'value' => 'yes', 'description' => 'Enable forgot/recover password feature.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-register', 'value' => 'yes', 'description' => 'Enable new user register feature.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-multiple-resume', 'value' => 'no', 'description' => 'Enable multiple resume for a candidate.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-apply-without-static-resume', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-admin-lang-select', 'value' => 'yes'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-front-lang-select', 'value' => 'yes'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-front-salary-filter', 'value' => 'yes'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'front-salary-filter-min-value', 'value' => '0'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'front-salary-filter-max-value', 'value' => '100000'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'salary-currency', 'value' => '$'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'limit-team-members-to-only-view-their-created-jobs', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-overall-result-edit', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'departments-filters-limit', 'value' => '6'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'departments-home-limit', 'value' => '12'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'date-format', 'value' => 'd M, Y'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'display-candidate-interviews', 'value' => 'description_only'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'display-jobs-to-only-logged-in-users', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'hide-jobs-after-expiry', 'value' => 'no'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-jobs-schema', 'value' => 'no'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-qualifications-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-experiences-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-achievements-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-skills-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-languages-resume-nos-required', 'value' => '1',),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'min-references-resume-nos-required', 'value' => '1',),

            array('type' => 'heading', 'user_id' => 0, 'category' => 'General', 'key' => $smtpTutorial, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp', 'value' => 'no', 'description' => 'Enable external smtp for emails (selecting no will use default hosting email settings e.g. sendmail)', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-host', 'value' => 'smtp.gmail.com', 'description' => 'Define smtp host.', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-port', 'value' => '465', 'description' => 'Define smtp port.', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-protocol', 'value' => 'ssl', 'description' => 'Define smtp rotocol.', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-username', 'value' => 'your-gmail@gmail.com', 'description' => 'Define smtp username.', 'options' => ''),
            array('type' => 'password', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-password', 'value' => 'Abcd1234!', 'description' => 'Define smtp password.', 'options' => ''),

            //Apis menu
            array('type' => 'heading', 'user_id' => 0, 'category' => 'Apis', 'key' => $googleTut, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Apis', 'key' => 'enable-google-login', 'value' => 'yes', 'description' => 'Enable google login.', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-client-id', 'value' => 'abcd1234', 'description' => 'Define Google client id', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-client-secret', 'value' => 'abcd1234', 'description' => 'Define Google client secret', 'options' => ''),
            array('type' => 'readonly', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-app-redirect', 'value' => CF_BASE_URL.'/google-redirect', 'description' => 'Paste this redirect uri in google app console.', 'options' => ''),

            array('type' => 'heading', 'user_id' => 0, 'category' => 'Apis', 'key' => $linkedinTut, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Apis', 'key' => 'enable-linkedin-login', 'value' => 'yes', 'description' => 'Enable linkedin login.', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-id', 'value' => 'abcd1234', 'description' => 'Define linkedin App id', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-secret', 'value' => 'abcd1234', 'description' => 'Define linkedin App secret', 'options' => ''),
            array('type' => 'readonly', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-redirect', 'value' => CF_BASE_URL.'/linkedin-redirect', 'description' => 'Paste this redirect uri in linkedin app console.', 'options' => ''),

            //Colors Alignment menu
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'banner-text-color',  'value' => '#f4f4f4', 'description' => 'Select Banner text color'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'site-background',  'value' => '#f4f4f4', 'description' => 'Select background color for site content area (#f4f4f4)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'headings-underline-color',  'value' => '#56c7ff', 'description' => 'Select colors for heading underline (#56c7ff)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-background', 'value' => '#1D3352', 'description' => 'Select background color for footer (#1D3352)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-items-color', 'value' => '#FFFFFF', 'description' => 'Select items color for footer (#FFFFFF)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-social-icons-color',  'value' => '#56c7ff', 'description' => 'Define color for footer social icons (#56c7ff)'),

        );

        foreach ($data as $d) {
            $d['value'] = str_replace('"', "'", $d['value']);
            $this->db->where('key', $d['key']);
            $this->db->where('user_id', 0);
            $result = $this->db->get('settings');
            if ($result->num_rows() <= 0) {
                $this->db->insert('settings', $d);
            }
        }
    }

    public function importUpdate()
    {
        $v2_2 = '<ul><li>Added : Setting for file upload limit.</li><li>Added : Hide job after last date setting.</li><li>Added : Structured schema.</li><li>Added : Jobs Import via csv.</li><li>Fixed : Candidate signup email notifications to admin issue.</li><li>Fixed : Home page banner issue.</li><li>Fixed : php8 compatibility issues.</li><li>Fixed : Missing logo issue in some email templates.</li><li>Fixed : Missing Favicon image link issue.</li><li>Fixed : Admin candidates list sorting issue.</li><li>Fixed : Admin candidates create/edit missing date issue.</li></ul>';
        $v2_1 = '<ul><li>Added : Admin job apply for a candidate.</li><li>Added : "SSl/TLS" option in admin email settings.</li><li>Added : Date format setting in admin</li><li>Fixed : Candidate account activation page missing variable issue.</li><li>Fixed : Admin -> Custom Css update isse</li><li>Fixed : Jobs list function parameter issue.</li><li>Fixed : Jobs list pagination issue.</li><li>Fixed : PDF resume -> missing imag issue.</li><li>Fixed : Google login redirect issue.</li><li>Fixed : Job apply, traits insert issue.</li><li>Fixed : Candidate password update issue.</li><li>Fixed : Google login redirect issue when account exist with email.</li></ul>';
        $v2_0 = '<ul><li>Added : Color panel for color selection.</li><li>Added : Dark mode theme.</li><li>Added : Admin settings for css colors.</li><li>Added : Setting to select number of departments on home page.</li><li>Added : Limit setting for departments on homepage and job list page.</li><li>Added : Settings for department display on home page</li><li>Added : Settings for department filter display on jobs list page.</li><li>Fixed : Email config for ssl added.</li><li>Fixed : HTML formatting issue in job description and long words css apply.</li><li>Fixed : Language loader issue during installation</li><li>Fixed : Missing language translation phrases.</li><li>Fixed : Adjusted php8 compatibility issues.</li></ul>';
        $v1_9 = '<ul><li>Added : Candidate skills in resume builder.</li><li>Added : Filter added for skills in Admin Candidates listing.</li><li>Added : Option to display jobs to only logged in users.</li><li>Added : Ability to edit overall result in admin job board.</li><li>Fixed : Installer issues</li><li>Fixed : Missing language translation phrases in email templates.</li><li>Fixed : PHP 8 compatibility issues.</li><li>Fixed : Default language issue.</li><li>Fixed : Third party oAuth image issue.</li><li>Fixed : Salary range filter issue in candidate area.</li><li>Fixed : Month names in dates not translatable.</li><li>Fixed : Labels in Settings Apis.</li><li>Fixed : Job link in refer job email.</li></ul>';
        $v1_8 = '<ul><li>Added : Slugs to jobs via job creation replacing ids.</li><li>Added : On page meta keywords and meta description in jobs create/edit.</li><li>Added : Min and Max Salary fields in jobs and their filters in candidate section.</li><li>Added : Setting for team members to be only able to see their corrected jobs.</li><li>Fixed : Default language not being loaded for candidate section.</li><li>Fixed : Permission names not translatable.</li><li>Fixed : Month names in dates not translatable.</li></ul>';
        $v1_7 = '<ul><li>Added : Front account button converted to drop down links after login.</li><li>Added : Filters for gender, age, locations in candidates list.</li><li>Added : Filters for gender, age, locations in job board / job applications.</li><li>Added : Candidate interview list in candidate section.</li><li>Added : Setting in admin to display assigned interview to candidate or not.</li><li>Fixed : Missing smtp settings in admin.</li></ul>';
        $v1_6 = '<ul><li>Added : Support for RTL</li><li>Added : Language Selectors dropdown with flags in admin and candidate area.</li><li>Added : Settings to display language selectors on candidate and admin area.</li><li>Added : Settings for forcing candidates to make resume before applying.</li><li>Added : Validation messages made multi language enabled and translatable.</li><li>Fixed : DB Port issue after installation.</li><li>Fixed : Missing placeholders with language translations for form fields.</li></ul>';
        $v1_5 = '<ul><li>Added : Display job filters on home banner.</li><li>Added : Delete job application feature from job board.</li><li>Added : Show rejected in candidate area in job applications when rejected.</li><li>Added : Interview view/conduct from job board.</li><li>Fixed : Footer text formatting issue.</li><li>Fixed : Datatables get requests converted to post requests.</li><li>Fixed : Individual job detail page job trait as lang.</li><li>Fixed : Interview pdf download error.</li></ul>';
        $v1_4 = '<ul><li>Added : Custom filters feature.</li><li>Added : Candidate creation by admin feature.</li><li>Added : Admin login as candidate feature</li><li>Added : Link for document resume in resume view.</li><li>Added : From email address field for mail send with auto detect domain in settings.</li><li>Added : Option to ask for data import during installation.</li><li>Fixed : Banner and logo upload issue.</li><li>Fixed : Linkedin oAuth remote request issue.</li><li>Fixed : Word wrap issue in description of job detail and blog detail page.</li><li>Fixed : Admin Job list bulk action issue.</li><li>Fixed : Email templates static logo issue.</li><li>Removed : Companies module as purpose can be served with job filters.</li></ul>';
        $v1_3 = '<ul><li>Added : Enable/Disable multiple resume feature.</li><li>Added : Search candidates by job titles and experience in candidates pool.</li><li>Fixed : "strict_sql_mode" issue.</li><li>Fixed : Candidate Interview remarks issue.</li></ul>';
        $v1_2 = '<ul><li>Added : Date, Time and Location field in interview assignment.</li><li>Added : Notifications to user and team member when interview assigns.</li><li>Added : Notification to user when quiz assigns.</li><li>Added : Message candidate feature.</li><li>Fixed : Setting -> Api redirect uri issue during installation.</li><li>Removed : Alphabetic charachter restriction from some fields to support multi language.</li></ul>';
        $v1_1 = '<ul><li>Added : Automatic update feature.</li><li>Fixed : Intaller issues.</li><li>Fixed : Some missing icons.</li></ul>';
        $data = array(
            array('title'=>'2.0','version'=>'2.2','details'=>$v2_2,'files'=>'','is_current'=>1,'released_at'=>'2023-11-11 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'2.0','version'=>'2.1','details'=>$v2_1,'files'=>'','is_current'=>0,'released_at'=>'2023-06-11 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'2.0','version'=>'2.0','details'=>$v2_0,'files'=>'','is_current'=>0,'released_at'=>'2022-09-12 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.9','version'=>'1.9','details'=>$v1_9,'files'=>'','is_current'=>0,'released_at'=>'2022-09-12 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.8','version'=>'1.8','details'=>$v1_8,'files'=>'','is_current'=>0,'released_at'=>'2022-07-27 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.7','version'=>'1.7','details'=>$v1_7,'files'=>'','is_current'=>0,'released_at'=>'2022-05-21 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.6','version'=>'1.6','details'=>$v1_6,'files'=>'','is_current'=>0,'released_at'=>'2022-03-30 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.5','version'=>'1.5','details'=>$v1_5,'files'=>'','is_current'=>0,'released_at'=>'2021-12-05 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.4','version'=>'1.4','details'=>$v1_4,'files'=>'','is_current'=>0,'released_at'=>'2021-05-17 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.3','version'=>'1.3','details'=>$v1_3,'files'=>'','is_current'=>0,'released_at'=>'2021-11-19 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.2','version'=>'1.2','details'=>$v1_2,'files'=>'','is_current'=>0,'released_at'=>'2020-07-06 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
            array('title'=>'1.1','version'=>'1.1','details'=>$v1_1,'files'=>'','is_current'=>0,'released_at'=>'2020-06-03 00:00:00', 'created_at'=>date('Y-m-d G:i:s')),
        );

        //First making any other current one to not current
        $this->db->update('updates', array('is_current' => 0));

        foreach ($data as $d) {
            $this->db->where('version', $d['version']);
            $result = $this->db->get('updates');
            if ($result->num_rows() <= 0) {
                $this->db->insert('updates', $d);
            }
        }
    }
 
    public function importFooterSections()
    {
        $data = array(
            array(
                'title' => 'Column 1',
                'content' => getTextFromFile('col1.txt'),
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 2',
                'content' => '<div class="footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><a href="'.CF_BASE_URL.'/blog/'.encode(2).'">How To Apply</a></li>
                                <li><a href="'.CF_BASE_URL.'/jobs">Latest Jobs</a></li>
                                <li><a href="'.CF_BASE_URL.'/account">My Account</a></li>
                                <li><a href="'.CF_BASE_URL.'/blogs">News & Announcements</a></li>
                                <li><a href="'.CF_BASE_URL.'/blog/'.encode(4).'">Privacy policy</a></li>
                            </ul>
                            </div>',
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 3',
                'content' => '<div class="footer-links">
                            <h4>Latest Jobs</h4>
                            <ul>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(1).'">Marketing Executive</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(2).'">Accounts Manager</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(3).'">Computer System Analyst</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(4).'">Network Administrator</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(5).'">Project Manager</a></li>
                            </ul>
                            </div>',
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 4',
                'content' => getTextFromFile('col2.txt'),
                'updated_at' => date('Y-m-d G:i:s')
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('footer_sections');
            if ($result->num_rows() <= 0) {
                $this->db->insert('footer_sections', $d);
            }
        }
    }    

    public function importPermissionsData()
    {
        $data = array(
            //Dashboard
            array('category' => 'dashboard', 'title' => 'view dashboard stats', 'slug' => 'view_dashboard_stats',),
            array('category' => 'dashboard', 'title' => 'view job chart', 'slug' => 'view_job_chart',),
            array('category' => 'dashboard', 'title' => 'view candidate chart', 'slug' => 'view_candidate_chart',),
            array('category' => 'dashboard', 'title' => 'view jobs status', 'slug' => 'view_jobs_status',),
            array('category' => 'dashboard', 'title' => 'to do list', 'slug' => 'to_do_list',),
            //Job Board
            array('category' => 'job_board', 'title' => 'view job board', 'slug' => 'view_job_board',),
            array('category' => 'job_board', 'title' => 'actions job board', 'slug' => 'actions_job_board',),
            //Jobs
            array('category' => 'jobs', 'title' => 'view jobs', 'slug' => 'view_jobs',),
            array('category' => 'jobs', 'title' => 'create jobs', 'slug' => 'create_jobs',),
            array('category' => 'jobs', 'title' => 'edit jobs', 'slug' => 'edit_jobs',),
            array('category' => 'jobs', 'title' => 'delete jobs', 'slug' => 'delete_jobs',),
            //Job Filters
            array('category' => 'job_filters', 'title' => 'view job filters', 'slug' => 'view_job_filters',),
            array('category' => 'job_filters', 'title' => 'create job filters', 'slug' => 'create_job_filters',),
            array('category' => 'job_filters', 'title' => 'edit job filters', 'slug' => 'edit_job_filters',),
            array('category' => 'job_filters', 'title' => 'delete job filters', 'slug' => 'delete_job_filters',),
            //Companies
            array('category' => 'companies', 'title' => 'view companies', 'slug' => 'view_companies',),
            array('category' => 'companies', 'title' => 'create companies', 'slug' => 'create_companies',),
            array('category' => 'companies', 'title' => 'edit companies', 'slug' => 'edit_companies',),
            array('category' => 'companies', 'title' => 'delete companies', 'slug' => 'delete_companies',),
            //Departments
            array('category' => 'departments', 'title' => 'view departments', 'slug' => 'view_departments',),
            array('category' => 'departments', 'title' => 'create departments', 'slug' => 'create_departments',),
            array('category' => 'departments', 'title' => 'edit departments', 'slug' => 'edit_departments',),
            array('category' => 'departments', 'title' => 'delete departments', 'slug' => 'delete_departments',),
            //Quizes
            array('category' => 'quizes', 'title' => 'view quiz questions', 'slug' => 'view_quiz_questions',),
            array('category' => 'quizes', 'title' => 'add quiz questions', 'slug' => 'add_quiz_questions',),
            array('category' => 'quizes', 'title' => 'edit quiz questions', 'slug' => 'edit_quiz_questions',),
            array('category' => 'quizes', 'title' => 'delete quiz questions', 'slug' => 'delete_quiz_questions',),
            array('category' => 'quizes', 'title' => 'view quizes', 'slug' => 'view_quizes',),
            array('category' => 'quizes', 'title' => 'add quizes', 'slug' => 'add_quizes',),
            array('category' => 'quizes', 'title' => 'edit quizes', 'slug' => 'edit_quizes',),
            array('category' => 'quizes', 'title' => 'delete quizes', 'slug' => 'delete_quizes',),
            array('category' => 'quizes', 'title' => 'clone quizes', 'slug' => 'clone_quizes',),
            array('category' => 'quizes', 'title' => 'download quizes', 'slug' => 'download_quizes',),
            //Interviews
            array('category' => 'interviews', 'title' => 'view interview questions', 'slug' => 'view_interview_questions',),
            array('category' => 'interviews', 'title' => 'add interview questions', 'slug' => 'add_interview_questions',),
            array('category' => 'interviews', 'title' => 'edit interview questions', 'slug' => 'edit_interview_questions',),
            array('category' => 'interviews', 'title' => 'delete interview questions', 'slug' => 'delete_interview_questions',),
            array('category' => 'interviews', 'title' => 'view interviews', 'slug' => 'view_interviews',),
            array('category' => 'interviews', 'title' => 'add interviews', 'slug' => 'add_interviews',),
            array('category' => 'interviews', 'title' => 'edit interviews', 'slug' => 'edit_interviews',),
            array('category' => 'interviews', 'title' => 'delete interviews', 'slug' => 'delete_interviews',),
            array('category' => 'interviews', 'title' => 'clone interviews', 'slug' => 'clone_interviews',),
            array('category' => 'interviews', 'title' => 'download interviews', 'slug' => 'download_interviews',),
            array('category' => 'interviews', 'title' => 'all candidate interviews', 'slug' => 'all_candidate_interviews',),
            array('category' => 'interviews', 'title' => 'view conduct interviews', 'slug' => 'view_conduct_interviews',),
            //Traits
            array('category' => 'traits', 'title' => 'view traits', 'slug' => 'view_traits',),
            array('category' => 'traits', 'title' => 'create traits', 'slug' => 'create_traits',),
            array('category' => 'traits', 'title' => 'edit traits', 'slug' => 'edit_traits',),
            array('category' => 'traits', 'title' => 'delete traits', 'slug' => 'delete_traits',),
            //Question Categories
            array('category' => 'question_categories', 'title' => 'view question categories', 'slug' => 'view_question_categories',),
            array('category' => 'question_categories', 'title' => 'create question categories', 'slug' => 'create_question_categories',),
            array('category' => 'question_categories', 'title' => 'edit question categories', 'slug' => 'edit_question_categories',),
            array('category' => 'question_categories', 'title' => 'delete question categories', 'slug' => 'delete_question_categories',),
            //Quiz Categories
            array('category' => 'quiz_categories', 'title' => 'view quiz categories', 'slug' => 'view_quiz_categories',),
            array('category' => 'quiz_categories', 'title' => 'create quiz categories', 'slug' => 'create_quiz_categories',),
            array('category' => 'quiz_categories', 'title' => 'edit quiz categories', 'slug' => 'edit_quiz_categories',),
            array('category' => 'quiz_categories', 'title' => 'delete quiz categories', 'slug' => 'delete_quiz_categories',),
            //Interview Categories
            array('category' => 'interview_categories', 'title' => 'view interview categories', 'slug' => 'view_interview_categories',),
            array('category' => 'interview_categories', 'title' => 'create interview categories', 'slug' => 'create_interview_categories',),
            array('category' => 'interview_categories', 'title' => 'edit interview categories', 'slug' => 'edit_interview_categories',),
            array('category' => 'interview_categories', 'title' => 'delete interview categories', 'slug' => 'delete_interview_categories',),
            //Questions
            array('category' => 'questions', 'title' => 'view questions', 'slug' => 'view_questions',),
            array('category' => 'questions', 'title' => 'create questions', 'slug' => 'create_questions',),
            array('category' => 'questions', 'title' => 'edit questions', 'slug' => 'edit_questions',),
            array('category' => 'questions', 'title' => 'delete questions', 'slug' => 'delete_questions',),
            //Team
            array('category' => 'team', 'title' => 'view team listing', 'slug' => 'view_team_listing',),
            array('category' => 'team', 'title' => 'add team member', 'slug' => 'add_team_member',),
            array('category' => 'team', 'title' => 'edit team member', 'slug' => 'edit_team_member',),
            array('category' => 'team', 'title' => 'delete team member', 'slug' => 'delete_team_member',),
            array('category' => 'team', 'title' => 'view roles', 'slug' => 'view_roles',),
            array('category' => 'team', 'title' => 'add role', 'slug' => 'add_role',),
            array('category' => 'team', 'title' => 'edit role', 'slug' => 'edit_role',),
            array('category' => 'team', 'title' => 'delete role', 'slug' => 'delete_role',),
            //Candidates
            array('category' => 'candidates', 'title' => 'view candidate listing', 'slug' => 'view_candidate_listing',),
            array('category' => 'candidates', 'title' => 'add candidate', 'slug' => 'add_candidate',),
            array('category' => 'candidates', 'title' => 'edit candidate', 'slug' => 'edit_candidate',),
            array('category' => 'candidates', 'title' => 'delete candidate', 'slug' => 'delete_candidate',),
            array('category' => 'candidates', 'title' => 'login as candidate', 'slug' => 'login_as_candidate',),
            //Blog
            array('category' => 'blog', 'title' => 'view blog listing', 'slug' => 'view_blog_listing',),
            array('category' => 'blog', 'title' => 'add blog', 'slug' => 'add_blog',),
            array('category' => 'blog', 'title' => 'edit blog', 'slug' => 'edit_blog',),
            array('category' => 'blog', 'title' => 'delete blog', 'slug' => 'delete_blog',),
            array('category' => 'blog', 'title' => 'view blog categories', 'slug' => 'view_blog_categories',),
            array('category' => 'blog', 'title' => 'add blog categories', 'slug' => 'add_blog_categories',),
            array('category' => 'blog', 'title' => 'edit blog categories', 'slug' => 'edit_blog_categories',),
            array('category' => 'blog', 'title' => 'delete blog categories', 'slug' => 'delete_blog_categories',),
            //Settings
            array('category' => 'settings', 'title' => 'general settings', 'slug' => 'general_settings',),
            array('category' => 'settings', 'title' => 'display settings', 'slug' => 'display_settings',),
            array('category' => 'settings', 'title' => 'home page settings', 'slug' => 'home_page_settings',),
            array('category' => 'settings', 'title' => 'footer settings', 'slug' => 'footer_settings',),
            array('category' => 'settings', 'title' => 'apis settings', 'slug' => 'apis_settings',),
            array('category' => 'settings', 'title' => 'css settings', 'slug' => 'css_settings',),
            array('category' => 'settings', 'title' => 'languages settings', 'slug' => 'languages_settings',),
            array('category' => 'settings', 'title' => 'update application', 'slug' => 'update_application',),
        );
        foreach ($data as $d) {
            $this->db->where('slug', $d['slug']);
            $result = $this->db->get('permissions');
            if ($result->num_rows() <= 0) {
                $this->db->insert('permissions', $d);
                $id = $this->db->insert_id();
            }
        }
    }
   
    public function importLanguagesData()
    {
        $d = date('Y-m-d G:i:s');
        $data = array(
            array(
                'title' => 'Origin',
                'slug' => 'origin',
                'status' => 1,
                'is_selected' => 0,
                'is_main' => 1,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'us',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'English',
                'slug' => 'english',
                'status' => 1,
                'is_selected' => 1,
                'is_default' => 1,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'us',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Chinese',
                'slug' => 'chinese',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'cn',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Danish',
                'slug' => 'danish',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'dk',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Dutch',
                'slug' => 'dutch',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'nl',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'French',
                'slug' => 'french',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'fr',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'German',
                'slug' => 'german',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'de',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Italian',
                'slug' => 'italian',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'it',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Polish',
                'slug' => 'polish',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'pl',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Russian',
                'slug' => 'russian',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'ru',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Spanish',
                'slug' => 'spanish',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'ltr',
                'display' => 'both',
                'flag' => 'es',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'عربي',
                'slug' => 'arabic',
                'status' => 1,
                'is_selected' => 0,
                'direction' => 'rtl',
                'display' => 'both',
                'flag' => 'sa',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('languages');
            if ($result->num_rows() <= 0) {
                $this->db->insert('languages', $d);
            }
        }
    }


}