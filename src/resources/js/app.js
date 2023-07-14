import 'bootstrap';

import TomSelect from "tom-select";
import flatpickr from "flatpickr";

document.querySelectorAll('.tomselect')
    .forEach((selectField) => {
        let plugins = ['dropdown_input', 'clear_button'];
        if(selectField.multiple) {
            plugins.push('remove_button');
        }

        new TomSelect(selectField, {
            plugins,
        });
    });

document.querySelectorAll('.flatpickr')
    .forEach((dateField) => {
        flatpickr(dateField);
    })
