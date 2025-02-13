<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4 class="tw-mt-0 tw-mb-3 tw-font-semibold tw-text-lg section-heading section-heading-open-ticket">
    <?php echo _l('clients_ticket_open_subject'); ?>
</h4>
<?php echo form_open_multipart('clients/open_ticket', ['id' => 'open-new-ticket-form']); ?>

<!-- Gizli Departman ve Öncelik Seçimi -->
<input type="hidden" name="department" value="7">
<input type="hidden" name="priority" value="2">

<div class="row">
    <div class="col-md-12">
        <?php hooks()->do_action('before_client_open_ticket_form_start'); ?>
        <div class="panel_s">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group open-ticket-subject-group">
                            <label for="subject"><?php echo _l('customer_ticket_subject'); ?></label>
                            <input type="text" class="form-control" name="subject" id="subject"
                                value="<?php echo set_value('subject'); ?>">
                            <?php echo form_error('subject'); ?>
                        </div>
                        <?php if (total_rows(db_prefix() . 'projects', ['clientid' => get_client_user_id()]) > 0 && has_contact_permission('projects')) { ?>
                        <div class="form-group open-ticket-project-group">
                            <label for="project_id"><?php echo _l('project'); ?></label>
                            <select data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"
                                name="project_id" id="project_id" class="form-control selectpicker">
                                <option value=""></option>
                                <?php foreach ($projects as $project) { ?>
                                <option value="<?php echo e($project['id']); ?>" <?php echo set_select('project_id', $project['id']); ?><?php if ($this->input->get('project_id') == $project['id']) {
    echo ' selected';
} ?>><?php echo e($project['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                        <div class="row">
                        </div>
                        <?php
                  if (get_option('services') == 1 && count($services) > 0) { ?>
                        <div class="form-group open-ticket-service-group">
                            <label for="service"><?php echo _l('clients_ticket_open_service'); ?></label>
                            <select data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"
                                name="service" id="service" class="form-control selectpicker">
                                <option value=""></option>
                                <?php foreach ($services as $service) { ?>
                                <option value="<?php echo e($service['serviceid']); ?>"
                                    <?php echo set_select('service', $service['serviceid'], (count($services) == 1 ? true : false)); ?>>
                                    <?php echo e($service['name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                        <div class="custom-fields">
                            <?php echo render_custom_fields('tickets', '', ['show_on_client_portal' => 1]); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group open-ticket-message-group">
                    <label for="message"><?php echo _l('clients_ticket_open_body'); ?></label>
                    <textarea name="message" id="message" class="form-control"
                        placeholder="<?php echo _l('clients_ticket_open_body'); ?>"
                        rows="8"><?php echo set_value('message'); ?></textarea>
                </div>

                <div class="attachments_area open-ticket-attachments-area">
                    <div class="attachments">
                        <div class="attachment tw-max-w-md">
                            <div class="form-group">
                                <label for="attachment" class="control-label">
                                    <?php echo _l('clients_ticket_attachments'); ?>
                                </label>
                                <div class="input-group">
                                    <input type="file"
                                        extension="<?php echo str_replace(['.', ' '], '', get_option('ticket_attachments_file_extensions')); ?>"
                                        filesize="<?php echo file_upload_max_size(); ?>" class="form-control"
                                        name="attachments[0]" accept="<?php echo get_ticket_form_accepted_mimes(); ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default add_more_attachments"
                                            data-max="<?php echo get_option('maximum_allowed_ticket_attachments'); ?>"
                                            type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button type="submit" class="btn btn-primary" data-form="#open-new-ticket-form" autocomplete="off"
                    data-loading-text="<?php echo _l('wait_text'); ?>">
                    <?php echo _l('submit'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
