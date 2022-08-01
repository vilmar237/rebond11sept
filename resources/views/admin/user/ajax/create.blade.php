<div class="wrapper">
    <div class="dashboard-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-main-title">
                        <h3><i class="fa-solid fa-user-group me-3"></i>Ajouter un membre</h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="conversion-setup">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addorganisationLabel">Détails du membre</h5>
                            </div>
                            <x-form id="save-employee-data-form">
                                @include('sections.password-autocomplete-hide')
                                <div class="container bg-white rounded">
                                    <div class="row p-20">
                                        <div class="col-lg-9 col-xl-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <x-forms.text fieldId="first_name" :fieldLabel="__('modules.employees.firstname')"
                                                        fieldName="first_name" fieldRequired="true" :fieldPlaceholder="__('placeholders.firstname')">
                                                    </x-forms.text>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <x-forms.text fieldId="last_name" :fieldLabel="__('modules.employees.employeeName')"
                                                        fieldName="last_name" fieldRequired="true" :fieldPlaceholder="__('placeholders.name')">
                                                    </x-forms.text>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <x-forms.text fieldId="email" :fieldLabel="__('modules.employees.employeeEmail')"
                                                        fieldName="email" fieldRequired="true" :fieldPlaceholder="__('placeholders.email')">
                                                    </x-forms.text>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <x-forms.label class="mt-3" fieldId="password"
                                                        :fieldLabel="__('app.password')" fieldRequired="true">
                                                    </x-forms.label>
                                                    <x-forms.input-group>

                                                        <input type="password" name="password" id="password"
                                                            class="form-control height-35 f-14">
                                                        <x-slot name="preappend">
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                data-bs-original-title="@lang('app.viewPassword')"
                                                                class="btn btn-outline-secondary border-grey height-35 toggle-password"><i
                                                                    class="fa fa-eye"></i></button>
                                                        </x-slot>
                                                        <x-slot name="append">
                                                            <button id="random_password" type="button" data-bs-toggle="tooltip"
                                                                data-bs-original-title="@lang('modules.client.generateRandomPassword')"
                                                                class="btn btn-outline-secondary border-grey height-35"><i
                                                                    class="fa fa-random"></i></button>
                                                        </x-slot>
                                                    </x-forms.input-group>
                                                    <small class="form-text text-muted">@lang('placeholders.password')</small>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <x-forms.label class="my-3" fieldId="category_id"
                                                        :fieldLabel="__('app.designation')" fieldRequired="true">
                                                    </x-forms.label>
                                                    <x-forms.input-group>
                                                        <select class="selectpicker" name="role"
                                                            id="employee_designation" data-live-search="true">
                                                            <option value="">--</option>
                                                            @foreach ($roles as $designation)
                                                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        
                                                    </x-forms.input-group>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xl-2">
                                            <x-forms.file allowedFileExtensions="png jpg jpeg" class="mr-0 mr-lg-2 mr-md-2 cropper"
                                                :fieldLabel="__('modules.profile.profilePicture')" fieldName="image" fieldId="image"
                                                fieldHeight="119" :popover="__('messages.fileFormat.ImageFile')" />
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <x-forms.tel fieldId="mobile" :fieldLabel="__('app.mobile')" fieldName="phone"
                                                fieldPlaceholder="ex. 695035506"></x-forms.tel>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <x-forms.select fieldId="gender" fieldClass="selectpicker" :fieldLabel="__('modules.employees.gender')"
                                                fieldName="gender">
                                                <option value="">--</option>
                                                <option value="male">@lang('app.male')</option>
                                                <option value="female">@lang('app.female')</option>
                                                <option value="others">@lang('app.others')</option>
                                            </x-forms.select>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <x-forms.datepicker fieldId="joining_date" :fieldLabel="__('modules.employees.joiningDate')"
                                                fieldName="joining_date" :fieldPlaceholder="__('placeholders.date')" fieldRequired="true"
                                                :fieldValue="now(global_setting()->timezone)->format(global_setting()->date_format)" />
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <x-forms.datepicker fieldId="date_of_birth" :fieldLabel="__('modules.employees.dateOfBirth')"
                                                fieldName="date_of_birth" :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group my-3">
                                                <x-forms.textarea class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.address')"
                                                    fieldName="address" fieldId="address" :fieldPlaceholder="__('placeholders.address')">
                                                </x-forms.textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addorganisationLabel">@lang('modules.client.clientOtherDetails')</h5>
                                    </div>
                                        
                                    <div class="row p-20">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-group my-3">
                                                <label class="f-14 text-dark-grey mb-12 w-100"
                                                    for="usr">@lang('modules.client.clientCanLogin')</label>
                                                <div class="d-flex">
                                                    <x-forms.radio fieldId="login-yes" :fieldLabel="__('app.yes')" fieldName="login"
                                                        fieldValue="enable" checked="true">
                                                    </x-forms.radio>
                                                    <x-forms.radio fieldId="login-no" :fieldLabel="__('app.no')" fieldValue="disable"
                                                        fieldName="login"></x-forms.radio>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-group my-3">
                                                <label class="f-14 text-dark-grey mb-12 w-100"
                                                    for="usr">@lang('modules.emailSettings.emailNotifications')</label>
                                                <div class="d-flex">
                                                    <x-forms.radio fieldId="notification-yes" :fieldLabel="__('app.yes')" fieldValue="yes"
                                                        fieldName="email_notifications" checked="true">
                                                    </x-forms.radio>
                                                    <x-forms.radio fieldId="notification-no" :fieldLabel="__('app.no')" fieldValue="no"
                                                        fieldName="email_notifications">
                                                    </x-forms.radio>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <x-forms.label class="my-3" fieldId="slack_username"
                                                :fieldLabel="__('modules.employees.slackUsername')"></x-forms.label>
                                            <x-forms.input-group>
                                                <x-slot name="prepend">
                                                    <span class="input-group-text f-14 bg-white-shade">@</span>
                                                </x-slot>

                                                <input type="text" class="form-control height-35 f-14" name="slack_username"
                                                    id="slack_username">
                                            </x-forms.input-group>
                                        </div>
                                    </div>

                                    <x-form-actions>
                                        <x-forms.button-primary id="save-employee-form" class="mr-3" icon="check">
                                            @lang('app.save')
                                        </x-forms.button-primary>
                                        <x-forms.button-cancel :link="route('user.index')" class="border-0">@lang('app.cancel')
                                        </x-forms.button-cancel>

                                    </x-form-actions>
                                </div>
                            </x-form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
