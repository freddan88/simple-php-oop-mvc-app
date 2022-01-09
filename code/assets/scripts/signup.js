const signupForm = document.getElementById("signup-form");

if (signupForm) {
  const apiEndpoint = "/api/signup";
  signupForm.addEventListener("submit", (event) =>
    submitFormData(event, apiEndpoint)
  );
}
