Calc = function (calcId, standard, enhanced, interestOnly, homeReversion, calcName) {
    var self = this;
    self.calcId = calcId;
    self.standard = standard;
    self.enhanced = enhanced;
    self.interestOnly = interestOnly;
    self.homeReversion = homeReversion;
    self.calcName = calcName;

    self.formater = function (value, separator) {
        var value = value.replace(/\D*|\w*/g, '');
        if (value.length != 0) {
            value = '£' + value.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1' + separator);
        }
        return value;
    };
    self.addPound = function addPound() {
        var poundThis = jQuery(this);
        var res = self.formater(poundThis.val(), ' ');
        poundThis.val(res);
    };
    self.cleanNummber = function (el) {
        var result = el.val().replace(/\D*|\w*/g, '');
        return result;
    };
    self.setPercentage = function (json) {
        self.percentage = JSON.parse(json);
    };
    self.setPercentageHr = function (json) {
        self.percentageHr = JSON.parse(json);
    };
    self.validate = function (el, type) {
        var isValid = true;
        var val = el.val();
        switch (type) {
            case 'length':
                if (el.val().length == 0) {
                    el.addClass('erc_input_fields_alert_' + self.calcId);
                    isValid = false;
                } else {
                    el.removeClass('erc_input_fields_alert_' + self.calcId);
                }
                break;
            case 'numeric':
                var regex = /^[0-9_\b]+$/;
                if( !regex.test(el.val()) ) {
                    el.addClass('erc_input_fields_alert_' + self.calcId);
                    isValid = false;
                } else {
                    el.removeClass('erc_input_fields_alert_' + self.calcId);
                }
                break;
            case 'email':
                var regex =  /^([A-z0-9_\.-]+)@([A-z0-9_\.-]+)\.([a-z\.]{2,6})$/;
                if( !regex.test(el.val()) ) {
                    el.addClass('erc_input_fields_alert_' + self.calcId);
                    isValid = false;
                } else {
                    el.removeClass('erc_input_fields_alert_' + self.calcId);
                }
                break;
        }

        return isValid;
    };

    self.maritalStatus = function (event, el) {
        var el = jQuery(this);
        var ageSpouse = jQuery('#erc_age_spouse_' + self.calcId);
        if (el.val() == 'single') {
            ageSpouse.prop('disabled', true);
            if (typeof jcf.refreshAll() == 'function') {
                jcf.refreshAll()
            }
        } else {
            ageSpouse.prop('disabled', false);
            if (typeof jcf.refreshAll() == 'function') {
                jcf.refreshAll()
            }
        }
    };

    self.nextStep = function () {
        var propertyValue = jQuery('#erc_property_value_' + self.calcId);
        var mortage = jQuery('#erc_mortage_' + self.calcId);
        var age = jQuery('#erc_age_' + self.calcId);
        var isValid = true;
        if (!self.validate(propertyValue, 'length')) {
            isValid = false;
        }
        if (!self.validate(mortage, 'length')) {
            isValid = false;
        }
        if (!isValid) {
            return false;
        }
        jQuery('#erc_selectable_step_one_' + self.calcId).hide();
        jQuery('#erc_selectable_step_two_' + self.calcId).show();
        jQuery('#erc_button_container_next_step_' + self.calcId).hide();
        jQuery('#erc_button_container_calculate_' + self.calcId).show();
        return false;
    };

    self.calculate = function () {
        var fullname = jQuery('#erc_fullname_' + self.calcId);
        var age = jQuery('#erc_age_' + self.calcId);
        var email = jQuery('#erc_email_' + self.calcId);
        var propertyValue = jQuery('#erc_property_value_' + self.calcId);
        var phone = jQuery('#erc_phone_' + self.calcId);
        var mortage = jQuery('#erc_mortage_' + self.calcId);
        var isValid = true;
        if (!self.validate(fullname, 'length')) {
            isValid = false;
        }
        if (!self.validate(email, 'email')) {
            isValid = false;
        }
        if (!self.validate(phone, 'length')) {
            isValid = false;
        }
        if (!self.validate(propertyValue, 'length')) {
            isValid = false;
        }

        if (!self.validate(mortage, 'length')) {
            isValid = false;
        }

        if (!isValid) {
            return false;
        }

        var standard = 'N/A';
        var enhanced = 'N/A';
        var interestOnly = 'N/A';
        var homeReversion = 'N/A';
        var gender = 'N/A';
        var maritalStatus = 'N/A';
        var ageSpouse = 'N/A';
        var erPercent = 'N/A';
        for (var i = 0; i < self.percentage.length; i++) {
            if (age.val() != self.percentage[i]['age']) {
                continue;
            }
            if (self.standard) {
                standard = self.cleanNummber(propertyValue) * self.percentage[i]['standard'] / 100;
                standard = standard.toFixed(0);
                jQuery("#result_standard_" + self.calcId).html(self.formater(standard, ','));
            }
            if (self.enhanced) {
                enhanced = self.cleanNummber(propertyValue) * self.percentage[i]['enhanced'] / 100;
                enhanced = enhanced.toFixed(0);
                jQuery("#result_enhanced_" + self.calcId).html(self.formater(enhanced, ','));
            }
            if (self.interestOnly) {
                interestOnly = self.cleanNummber(propertyValue) * self.percentage[i]['interest_only'] / 100;
                interestOnly = interestOnly.toFixed(0);
                jQuery("#result_interest_only_" + self.calcId).html(self.formater(interestOnly, ','));
            }
            if (self.homeReversion) {
                gender = jQuery('#erc_gender_' + self.calcId);
                maritalStatus = jQuery('#erc_marital_status_' + self.calcId);
                ageSpouse = jQuery('#erc_age_spouse_' + self.calcId);
                erPercent = jQuery('#erc_percent_er_' + self.calcId);

                $percentPropertyValue = self.cleanNummber(propertyValue) * erPercent.val() / 100;
                if (maritalStatus.val() == 'single') {
                    if (gender.val() == 'male') {
                        for (var i = 0; i < self.percentageHr.length; i++) {
                            if (age.val() != self.percentageHr[i]['age']) {
                                continue;
                            }
                            homeReversion = $percentPropertyValue * self.percentageHr[i]['male'] / 100;
                            homeReversion = homeReversion.toFixed(0);
                        }
                    } else if (gender.val() == 'female') {
                        for (var i = 0; i < self.percentageHr.length; i++) {
                            if (age.val() != self.percentageHr[i]['age']) {
                                continue;
                            }
                            homeReversion = $percentPropertyValue * self.percentageHr[i]['female'] / 100;
                            homeReversion = homeReversion.toFixed(0);
                        }
                    }
                } else if (maritalStatus.val() == 'married') {
                    var a = ageSpouse.val();
                    if (age.val() < ageSpouse.val()) {
                        a = age.val();
                    }
                    for (var i = 0; i < self.percentageHr.length; i++) {
                        if (a != self.percentageHr[i]['age']) {
                            continue;
                        }
                        homeReversion = $percentPropertyValue * self.percentageHr[i]['joint'] / 100;
                        homeReversion = homeReversion.toFixed(0);
                    }
                }
                jQuery("#result_home_reversion_" + self.calcId).html(self.formater(homeReversion, ','));
            }
            break;
        };

        jQuery.ajax({
            url: er_calculator_vars.ajax_url,
            type: 'POST',
            data: {
                'calcId': self.calcId,
                'calc_name': self.calcName,
                'form_data': 'ok',
                'action': 'er_calculator_calculate',
                'wpnonce': er_calculator_vars.wpnonce_calculate,
                'full_name': fullname.val(),
                'age': age.val(),
                'marital_status': jQuery('#erc_marital_status_' + self.calcId).val() ? jQuery('#erc_marital_status_' + self.calcId).val() : 'N/A',
                'age_spouse': jQuery('#erc_age_spouse_' + self.calcId).val() ? jQuery('#erc_age_spouse_' + self.calcId).val() : 'N/A',
                'gender': jQuery('#erc_gender_' + self.calcId).val() ? jQuery('#erc_gender_' + self.calcId).val() : 'N/A',
                'percent_er': jQuery('#erc_percent_er_' + self.calcId).val() ? jQuery('#erc_percent_er_' + self.calcId).val() : 'N/A',
                'email': email.val(),
                'property_value': self.cleanNummber(propertyValue),
                'phone': phone.val(),
                'mortage': self.cleanNummber(mortage),
                'standard': standard,
                'enhanced': enhanced,
                'interest_only': interestOnly,
                'home_reversion': homeReversion
            }
        });

        jQuery.ajax({
            url: er_calculator_vars.ajax_url,
            type: 'POST',
            'dataType ': 'html',
            data: {
                'adwords': self.calcId,
                'action': 'er_calculator_adwords',
                'wpnonce': er_calculator_vars.wpnonce_adwords
            }
        }).done(function (msg) {
            jQuery('#adwordsCode').html(msg);
        });

        jQuery('#erc_selectable_step_two_' + self.calcId).hide();
        jQuery('#erc_button_container_calculate_' + self.calcId).hide();
        jQuery('#erc_button_container_recalculate_' + self.calcId).show();
        jQuery('#erc_result_' + self.calcId).show();
        jQuery('#area_one_line_' + self.calcId).hide();
        jQuery('#text_area_one_' + self.calcId).hide();
        jQuery('#result_area_one_line_' + self.calcId).show();
        jQuery('#result_text_area_one_' + self.calcId).show();
        jQuery('#area_two_line_' + self.calcId).hide();
        jQuery('#text_area_two_' + self.calcId).hide();
        jQuery('#result_area_two_line_' + self.calcId).show();
        jQuery('#result_text_area_two_' + self.calcId).show();
        window.uetq = window.uetq || [];
        window.uetq.push({'ec': 'Calculator', 'ea': 'Submit_Email', 'el': 'Conversion', 'ev': '1'});
        return false;
    };

    self.recalculate = function () {
        jQuery('#erc_selectable_step_one_' + self.calcId).show();
        jQuery('#erc_selectable_step_two_' + self.calcId).hide();
        jQuery('#erc_button_container_recalculate_' + self.calcId).hide();
        jQuery('#erc_button_container_next_step_' + self.calcId).show();
        jQuery('#erc_result_' + self.calcId).hide();
        jQuery('#erc_property_value_' + self.calcId).val('');
        jQuery('#erc_mortage_' + self.calcId).val('');
        jQuery('#erc_email_' + self.calcId).val('');
        jQuery('#erc_phone_' + self.calcId).val('');

        jQuery('#area_one_line_' + self.calcId).show();
        jQuery('#text_area_one_' + self.calcId).show();
        jQuery('#result_area_one_line_' + self.calcId).hide();
        jQuery('#result_text_area_one_' + self.calcId).hide();

        jQuery('#area_two_line_' + self.calcId).show();
        jQuery('#text_area_two_' + self.calcId).show();
        jQuery('#result_area_two_line_' + self.calcId).hide();
        jQuery('#result_text_area_two_' + self.calcId).hide();
        jQuery('#adwordsCode').html('');
        return false;
    };

    self.init = function () {
        jQuery('#erc_button_next_step_' + self.calcId).on('click', self.nextStep);
        jQuery('#erc_button_calculate_' + self.calcId).on('click', self.calculate);
        jQuery('#erc_button_recalculate_' + self.calcId).on('click', self.recalculate);

        jQuery('#erc_property_value_' + self.calcId).on('change', self.addPound);
        jQuery('#erc_mortage_' + self.calcId).on('change', self.addPound);
        jQuery('#erc_marital_status_' + self.calcId).on('change', self.maritalStatus).trigger('change');
    };
};