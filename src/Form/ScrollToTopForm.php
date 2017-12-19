<?php

/**
* @file
* Contains \Drupal\scroll_to_top\Form\ScrollToTopForm
*/

namespace Drupal\scroll_to_top\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ScrollToTopForm extends ConfigFormBase{
    /*  function to get the id of the form  */
    public function getFormId(){
        return 'scroll_to_top_form';
    }
    
    /*  function to build the form where you can change the settings of the scroll to top button  */
    public function buildForm(array $form, FormStateInterface $form_state){
        $config = $this->config('scroll_to_top.settings')
            
    /*  label displayed in scroll to top link  */        
        $form['scroll_to_top_label'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Label'),
    '#description' => $this->t('label displayed in scroll to top link, default "Back to top".'),
    '#default_value' => $config->get('scroll_to_top_label'),
    '#size' => 10,
  );
        
  /*  position of the scroll to top button  */
  $form['scroll_to_top_position'] = array(
    '#title' => $this->t('Position'),
    '#description' => $this->t('Sroll to top button position'),
    '#type' => 'select',
    '#options' => array(
      1 => t('right'),
      2 => t('left'),
      3 => t('middle'),
    ),
    '#default_value' => $config->get('scroll_to_top_position'),
  );
        
  /*  background color of the scroll to top button when hovered over  */
  $form['scroll_to_top_bg_color_hover'] = array(
    '#type' => 'color',
    '#title' => $this->t('Background color on mouse over.'),
    '#description' => $this->t('Button background color on mouse over default #777777'),
    '#default_value' => $config->get('scroll_to_top_bg_color_hover'),
    '#size' => 10,
    '#maxlength' => 7,
  );
        
    /*  background color of the scroll to top button */
  $form['scroll_to_top_bg_color_out'] = array(
    '#type' => 'color',
    '#title' => $this->t('Background color on mouse out.'),
    '#description' => $this->t('Button background color on mouse over default #CCCCCC'),
    '#default_value' => $config->get('scroll_to_top_bg_color_out'),
    '#size' => 10,
    '#maxlength' => 7,
  );
        
    /*  text displayed under scroll to top button  */
  $form['scroll_to_top_display_text'] = array(
    '#type' => 'checkbox',
    '#title' => $this->t('Display label'),
    '#description' => $this->t('Display "BACK TO TOP" text under the button'),
    '#default_value' => $config->get('scroll_to_top_display_text'),
  );
    
    /*  enable the scroll to top button on the administration theme */
  $form['scroll_to_top_enable_admin_theme'] = array(
    '#type' => 'checkbox',
    '#title' => $this->t('Enable on administration theme.'),
    '#description' => $this->t('Enable scroll to top button on administration theme.'),
    '#default_value' => $config->get('scroll_to_top_enable_admin_theme'),
  );
        
    /*  preview settings  */    
  $form['scroll_to_top_preview'] = array(
    '#type' => 'item',
    '#title' => $this->t('Preview'),
    '#markup' => '<div id="scroll-to-top-prev-container">' . t('Change a setting value to see a preview. "Position" and "enable on admin theme" not included.') . '</div>',
  );
        
        return parent::buildForm($form, $form_state);
    }
    
    /*  function to save the settings form after it's changed  */
    public function submitForm(array &$form, FormStateInterface $form_state){
        parent::submitForm($form, $form_state);
        
        /*  get all form values  */
        $label = $form_state->getValue('scroll_to_top_label');
        $position = $form_state->getValue('scroll_to_top_position');
        $bg_color_hover = $form_state->getValue('scroll_to_top_bg_color_hover');
        $bg_color_out = $form_state->getValue('scroll_to_top_bg_color_out');
        $display_text = $form_state->getValue('scroll_to_top_display_text');
        $enable_admin_theme = $form_state->getValue('scroll_to_top_enable_admin_theme');
        
        /*  set all form values  */
        $config = $this->config('scroll_to_top.settings');
        $config->set('scroll_to_top_label', $label)
            ->set('scroll_to_top_position',$position)
            ->set('scroll_to_top_bg_color_hover', $bg_color_hover)
            ->set('scroll_to_top_bg_color_out', $bg_color_out)
            ->set('scroll_to_top_display_text', $display_text)
            ->set('scroll_to_top_enable_admin_theme', $enable_admin_theme)
            ->save();
    }
}