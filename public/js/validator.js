function Validator(formSelector) {
  var _this = this;
  function getParent(element, selector) {
    // while (element.parentElement.matches(selector)) {
    //   return element.parentElement;
    // }
    // element = parentElement;
    return element.closest(selector)
  }

  var formRules = {};
  var validationRules = {
    required: function (value) {
      if (typeof value === 'string') {
        value = value.trim();
      }
      return value ? undefined : 'Trường này không được để trống'
    },
    email: function (value) {
      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regex.test(value) ? undefined : 'Trường này phải là email'
    },
    confirm: function (selector) {
      return function confirm (value) {
        let value_ref = document.querySelector(`[name="${selector}"]`).value;
        return value_ref === value ? undefined : 'Mật khẩu chưa trùng khớp';
      }
    },
    date: function (value) {
      var regex = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/i;
      return regex.test(value) ? undefined : 'Định dạng ngày chưa hợp lệ';
    },
    phone: function (value) {
      var regex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
      return regex.test(value) ? undefined : `Số điện thoại chưa hợp lệ`
    },
    min: function (min, isNumber = false) {
      return function (value) {
        if (isNumber) {
          return Number(value.replaceAll(/,/g,'')) >= min ? undefined : `Trường này tối thiểu là ${min}`;
        }
        return value.length >= min ? undefined : `Trường này độ dài tối thiểu ${min} kí tự`;
      }
    },
    max: function (max, isNumber = false) {
      return function (value) {
        if (isNumber) {
          return Number(value.replaceAll(/,/g,'')) <= max ? undefined : `Trường này tối đa là ${max}`;
        }
        return value.length <= max ? undefined : `Trường này độ dài tối đa ${max} kí tự`;
      }
    },
    numeric: function (value) {
      return !isNaN(Number(value)) ? undefined : 'Trường này phải là số'
    },
    money: function (value) {
      return !isNaN(Number(value.replaceAll(/,/g,''))) ? undefined : 'Trường tiền chưa hợp lệ'
    },
    integer: function (value) {
      return Number.isInteger(Number(value)) ? undefined : 'Trường này phải là số nguyên'
    }
  }

  var formElement = document.querySelector(formSelector);
  if (formElement) {
    var inputElements = formElement.querySelectorAll('[name][rules]:not([readonly="readonly"])');
    Array.from(inputElements).forEach((input) => {
      var rules = input.getAttribute('rules').split('|');

      rules.forEach((rule) => {
        var ruleFunc = validationRules[rule];
        var isRuleHasValue = rule.includes(':');

        if (isRuleHasValue) {
          var ruleInfo = rule.split(':');
          ruleFunc = validationRules[ruleInfo[0]](ruleInfo[1]);

          var ruleNumbers = ['numeric', 'integer', 'money'];
          var isNumber = ruleNumbers.some((item) => rules.includes(item));
          var typeRuleNumber = ['min', 'max'];

          if (typeRuleNumber.includes(ruleInfo[0]) && isNumber) {
            ruleFunc = validationRules[ruleInfo[0]](ruleInfo[1], true);
          }
        }

        if (!Array.isArray(formRules[input.name])) {
          formRules[input.name] = [ruleFunc];
        } else {
          formRules[input.name].push(ruleFunc);
        }
      })
      
      // Lắng nghe sự kiện
      input.onblur = handleValidate;
      input.oninput = handleClearError;
    })

    function createElementError(message) {
      let div = document.createElement('div');
      div.className = 'invalid-feedback form-message d-block';
      div.textContent = message;
      return div;
    }

    function handleValidate(e) {
      // Lấy các function rule của input
      var rules = formRules[e.target.name];
      var errorMessage;
      for (var rule of rules) {
        errorMessage = rule(e.target.value);
        if (errorMessage) break;
      }

      // Nếu có lỗi 
      if (errorMessage) {
        var formGroup = getParent(e.target, '.form-group');
        if (formGroup) {
          var formMessage = formGroup.querySelector('.form-message');
          if (!formMessage) {
            formGroup.append(createElementError(errorMessage));
          }
          e.target.classList.add('is-invalid')
        }
      }
      return !errorMessage;
    }

    // Clear message lỗi
    function handleClearError(e) {
      var formGroup = getParent(e.target, '.form-group');
      if (formGroup) {
        var formMessage = formGroup.querySelector('.form-message');
        if (formMessage) {
          formMessage.remove()
        }
        e.target.classList.remove('is-invalid')
      }
    }

    // Xử lý hành vi submit form
    formElement.onsubmit = function (e) {
      e.preventDefault();
      var isValid = true;
      inputElements.forEach((input) => {
        if (!handleValidate({ target: input })) {
          isValid = false;
        }
      })
      if (isValid) {
        if (typeof _this.onSubmit === 'function') {
          var formValue = Array.from(inputElements).reduce((values, input) => {
            switch (input.type) {
              case 'checkbox':
                if (!input.matches(':checked')) {
                  values[input.name] = '';
                  return values;
                }
                if (!Array.isArray(values[input.name])) {
                  values[input.name] = [];
                }
                values[input.name].push(input.value);
                break;
              case 'radio':
                values[input.name] = document.querySelector(`input[name="${input.name}"]:checked`)?.value || '';
                break;
              case 'file':
                values[input.name] = input.files;
                break;
              default:
                values[input.name] = input.value;
            }
            return values;
          }, {})
          _this.onSubmit(formValue);
        } else {
          this.submit()
        }
      }
    }
  }
}