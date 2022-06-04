$(".passwordvalidator").on("keyup", function () {
  $(this).parsley().validate();
});

//has uppercase
window.ParsleyValidator.addValidator(
  "uppercase",
  function (value, requirement) {
    var uppercases = value.match(/[A-Z]/g) || [];
    return uppercases.length >= requirement;
  },
  32
).addMessage(
  "en",
  "uppercase",
  "Your password must contain at least (%s) uppercase letter."
);

//has lowercase
window.ParsleyValidator.addValidator(
  "lowercase",
  function (value, requirement) {
    var lowecases = value.match(/[a-z]/g) || [];
    return lowecases.length >= requirement;
  },
  32
).addMessage(
  "en",
  "lowercase",
  "Your password must contain at least (%s) lowercase letter."
);

//has number
window.ParsleyValidator.addValidator(
  "number",
  function (value, requirement) {
    var numbers = value.match(/[0-9]/g) || [];
    return numbers.length >= requirement;
  },
  32
).addMessage(
  "en",
  "number",
  "Your password must contain at least (%s) number."
);

//has special char
window.ParsleyValidator.addValidator(
  "special",
  function (value, requirement) {
    var specials = value.match(/[!@#\$*%\^&]/g) || [];
    return specials.length >= requirement;
  },
  32
).addMessage(
  "en",
  "special",
  "Your password must contain at least (%s) special characters."
);
