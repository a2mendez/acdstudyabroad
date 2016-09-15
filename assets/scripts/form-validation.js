function Validator(form) {


if (form.formFieldFirstName.value == '')
  {
    alert('Please enter your first name.');
    form.formFieldFirstName.focus();
    return false;
  }
  
  if (form.formFieldLastName.value == '')
  {
    alert('Please enter your last name.');
    form.formFieldLastName.focus();
    return false;
  }



var x = form.formField_Email.value;
var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/;
if (filter.test(x) == false) {
  alert('Please enter a valid e-mail address.');
  form.formField_Email.focus();
  return false;
 }


return true;
}