<?php


class GravityFormsPlaceholder_Plugin {

  

    function my_standard_settings($position, $form_id){
    
                // Create settings on position 25 (right after Field Label)
                
                if($position == 25){ ?>
                        
                <li class="admin_label_setting field_setting" style="display: list-item; ">
                <label for="field_placeholder">Placeholder Text
                
                <!-- Tooltip to help users understand what this field does -->
                <a href="javascript:void(0);" class="tooltip tooltip_form_field_placeholder" tooltip="&lt;h6&gt;Placeholder&lt;/h6&gt;Enter the placeholder/default text for this field.">(?)</a>
                            
                </label>
                        
                <input type="text" id="field_placeholder" class="fieldwidth-3" size="35" onKeyUp="SetFieldProperty('placeholder', this.value);">
                        
                </li><?php }
    }
    
    function my_gform_editor_js(){ ?>
                <script>
                //binding to the load field settings event to initialize the checkbox
                jQuery(document).bind("gform_load_field_settings", function(event, field, form){
                jQuery("#field_placeholder").val(field["placeholder"]);
                });
                </script>
                 <?php
    }
    
    function my_gform_enqueue_scripts($form, $is_ajax=false){ ?>
             <script>
             jQuery(document).ready(function($) {
                  <?php
                    foreach($form['fields'] as $i=>$field){
                            if(isset($field['placeholder']) && !empty($field['placeholder'])){?>
                    
                    $('#input_<?php echo $form['id']?>_<?php echo $field['id']?>').attr('placeholder','<?php echo $field['placeholder']?>');
                 <?php
                 }
                }
            ?>
                
             });
             </script>
                 <?php
    }
}          
            


