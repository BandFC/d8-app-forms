<?php
/**
 * @file
 * Contains \Drupal\apprenticeship_application\Form\PageExampleForm
 */
namespace Drupal\apprenticeship_application\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\basic_application\Form\BasicApplicationForm;

class ApprenticeshipApplicationForm extends BasicApplicationForm {

  /**
   * Send confirmation email
   */
  public function apprenticeship_application_confirmation_mail_send($form_values){

    $mailManager = \Drupal::service('plugin.manager.mail');

    //construct email to send to form submitter for confirmation
    $module = 'apprenticeship_application';
    $key = 'user_confirmation';
    $to = $form_values['email'];
    $from = \Drupal::config('system.site')->get('mail');
    $params['message'] = $form_values;
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;
    $result = $mailManager->mail($module, $key, $to, $langcode, $params, $from, $send);

    if ($result['result'] !== true) {
      drupal_set_message(t('There was a problem sending your email confirmation but your submission was successful.'), 'error');
    }
  }

  /**
   * Send confirmation email
   */
  public function apprenticeship_application_notification_mail_send($form_values){

    $mailManager = \Drupal::service('plugin.manager.mail');

    //construct email to send to form submitter for confirmation
    $module = 'apprenticeship_application';
    $key = 'admissions_notification';
    $to = 'admissions@blackpool.ac.uk';
    $from = \Drupal::config('system.site')->get('mail');
    $params['message'] = $form_values;
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;
    $result = $mailManager->mail($module, $key, $to, $langcode, $params, $from, $send);

    if ($result['result'] !== true) {
      drupal_set_message(t('There was a problem sending your email notification but your submission was successful.'), 'error');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'apprenticeship_application_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['qualifications'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Qualifications'),
      '#weight' => -2
    ];

    $form['qualifications']['qual'] = [
      '#type' => 'select',
      '#title' => $this->t('Qualification'),      
      '#required' => TRUE,
      '#options' => [
        '1' => $this->t('No qualifications'),
        '2' => $this->t('Completed GCSE programme or equivalent'),
        '3' => $this->t('Full Level 1 in subject area you are applying for'),
        '4' => $this->t('Full Level 2 in subject area you are applying for'),
        '5' => $this->t('4 GCSEs grade D or equivalent'),
        '6' => $this->t('4 GCSEs grade C'),
        '7' => $this->t('5 or more GCSEs grade C'),
        '8' => $this->t('A/S or A Levels or equivalent'),
        '9' => $this->t('HNC/HND, Degree or equivalent')
      ]
    ];

    $form['qualifications']['predict'] = [
      '#type' => 'select',
      '#title' => $this->t('Predicted or Achieved'),
      '#required' => TRUE,
      '#options' => [
        '1' => $this->t('Predicted'),
        '2' => $this->t('Achieved')
      ]
    ];

    $form['employer'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Employer Details'),
      '#weight' => 4
    ];

    $form['employer']['label'] = [      
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $this->t('If you already have an employer, and would like to study for an Apprenticeship with them, please give details below'),
    ];

   $form['employer']['employer_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Employer Name'),
      '#maxlength' => 128,
      '#required' => FALSE      
    ];

    $form['employer']['emp_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Employer Contact Number'),
      '#maxlength' => 15,
      '#required' => FALSE
    ];

    //inject course details from URL variable
    $form['course']['course_title']['#default_value'] = $this->t(\Drupal::request()->get('course_title'));
    $form['course']['course_code']['#default_value'] = $this->t(\Drupal::request()->get('course_code'));
    $form['course']['course_id']['#default_value'] = $this->t(\Drupal::request()->get('course_id')); 

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    //perform parent validation
    parent::validateForm($form, $form_state);
    //additional validation if required
    
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //perform parent submission
    parent::submitForm($form, $form_state);
    
    $form_values = $form_state->getValues();

    //send confirmation message to user
    $this->apprenticeship_application_confirmation_mail_send($form_values);

    //send notification message to admission
    $this->apprenticeship_application_notification_mail_send($form_values);
    
    //log submission in watchdog
    $message = "Apprenticeship Application Form Submitted";
    foreach($form_state->getValues() as $value){
      $message = $message . ' ' . $value;
    }
    \Drupal::logger('course_booking')->info($message);

    //interface information to EBS intermediate table
    $sid = time();

    // retrieve all mandatory values needed for EBS import 
    $title = $form_values['salutation'];
    $first_name = $form_values['first_name'];
    $surname = $form_values['surname_name'];
    $gender = $form_values['gender'];
    $date_of_birth = $form_values['dob'];
    $postcode = $form_values['postcode'];
    $house_name_number = $form_values['house'];
    $street_address = $form_values['street'];
    $town_city = $form_values['city'];
    $email = $form_values['email'];
    $mobile_phone_number = $form_values['phone_number'];
    $permanent_resident = $form_values['resident'];
    $disability = $form_values['disability'];
    $foster_care = $form_values['care'];
    $criminal_offence = $form_values['criminal'];    
    $qualification = $form_values['qual'];
    $predicted_or_achieved = $form_values['predict'];
    $course_title = $form_values['course_title'];
    $confirmation = $form_values['confirm'];
    $nationality = $form_values['nationality'];
    $country_of_birth = $form_values['country_of_birth'];

    // retrieve non-mandatory values with NULL value replacements
    if($form_values['middle_name']) str_replace("'", "''",$middle_names = $form_values['middle_name']); else $middle_names = '';
    if($form_values['ni_number']) str_replace("'", "''",$ni_number = $form_values['ni_number']); else $ni_number = '';
    if($form_values['doe']) $date_of_entry = $form_values['doe']; else $date_of_entry = '';
    if($form_values['employer_name']) str_replace("'", "''",$employer_name = $form_values['employer_name']); else $employer_name = '';
    if($form_values['county']) str_replace("'", "''",$county = $form_values['county']); else $county = '';
    if($form_values['course_code']) $course_code = $form_values['course_code']; else $course_code = '';
    if($form_values['course_id']) $uio_id = $form_values['course_id']; else $uio_id = 0;
    if($form_values['emp_number']) str_replace("'", "''",$employer_contact_number = $form_values['emp_number']); else $employer_contact_number = '';
    
    // set redundant fields
    $job_code = '';
    $school_college = '99999';    
    $career_goal = '';
    $home_phone_number = '';
    $including = '';
    
    // set application source [1] B&FC
    $app_source = 'WB';    
    $course_type = 'APP';

    // set database parameters
    $oracle_string = 'BANKDETSL';
    $oracle_user = 'drupaluser';
    $oracle_password = 'cr33per';

    // construct query to insert all form data
    $osql = "INSERT INTO APP_FORMS (
                submission_id,
                created_date,
                title,
                first_name,
                middle_names,
                surname,
                gender,
                date_of_birth,
                ni_number,
                postcode,
                house_name_number,
                street_address,
                town_city,
                email,
                mobile_phone_number,
                home_phone_number,
                permanent_resident,
                date_of_entry,
                disability_medical_cond,
                foster_care,
                criminal_offence,
                local_school_college,
                qualification,
                including,
                predicted_or_achieved,
                course_title,
                career_goal,
                employer_name,
                information_correct,
                county,
                course_code,
                course_type,
                nationality,
                country_of_birth,
                employer_contact_number,
                job_code,
                app_source,
                uio_id
              ) 
              VALUES (
                '$sid',
                SYSDATE, 
                '$title',
                '$first_name',
                '$middle_names',
                '$surname',
                '$gender',
                to_date('$date_of_birth','RRRR/MM/DD'),
                '$ni_number',
                '$postcode',
                '$house_name_number',
                '$street_address',
                '$town_city',
                '$email',
                '$mobile_phone_number',
                '$home_phone_number',
                '$permanent_resident',
                to_date('$date_of_entry','RRRR/MM/DD'),
                '$disability',
                '$foster_care',
                '$criminal_offence',
                '$school_college',
                '$qualification',
                '$including',
                '$predicted_or_achieved',
                '$course_title',
                '$career_goal',
                '$employer_name',
                '$confirmation',
                '$county',
                '$course_code',
                '$course_type',
                '$nationality',
                '$country_of_birth',
                '$employer_contact_number',
                '$job_code',
                '$app_source',
                '$uio_id')";


    // connect to EBS database
    $connection = oci_connect($oracle_user, $oracle_password, $oracle_string);

    // parse the query into the OCI and execute
    $rs = oci_parse($connection, $osql);
    $oe = oci_execute($rs);
  }
}