<?php $job_filters = issetVal($job, 'job_filters'); ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "JobPosting",
    "title": "<?php echo esc_output($job['title']); ?>",
    "description": "<?php echo esc_output($job['description'], 'raw'); ?>",
    "industry": "<?php echo esc_output($job['department']); ?>",
    "datePosted": "<?php echo esc_output($job['published_at']); ?>",
    "validThrough": "<?php echo esc_output($job['expiry_date']); ?>",
    "employmentType": "<?php echo getSchemaValuesFromFilterValues($job_filters, 'employmentType'); ?>",
    "hiringOrganization": {
        "@type": "Organization",
        "name": "<?php echo setting('site-name'); ?>",
        "sameAs": "<?php echo base_url(); ?>",
        "logo": "<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-logo'); ?>"
    },
    "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "<?php echo setting('salary-currency'); ?>",
        "value": {
            "@type": "QuantitativeValue",
            "value": <?php echo esc_output($job['max_salary']); ?>,
            "unitText": "MONTH"
        }
    },
	"educationRequirements" : {
		"@type" : "EducationalOccupationalCredential",
		"credentialCategory" : "<?php echo getSchemaValuesFromFilterValues($job_filters, 'educationRequirements'); ?>"
	},
	"experienceRequirements" : {
		"@type" : "OccupationalExperienceRequirements",
		"monthsOfExperience" : "<?php echo getSchemaValuesFromFilterValues($job_filters, 'experienceRequirements'); ?>"
	},    
}
</script>