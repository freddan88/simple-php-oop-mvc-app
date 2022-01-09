const handleApiResponse = (data) => {
  console.log(data);
};

const submitFormData = (event, apiEndpoint) => {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);
  // console.table([...formData]);

  fetch(apiEndpoint, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => handleApiResponse(data))
    .catch((error) => {
      console.error(error);
      handleApiResponse(error);
      console.error(error.message);
    });
};
