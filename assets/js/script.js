const wrapper = document.querySelector(".wrapper"),
    generateBtn = wrapper.querySelector(".form button"),
    qrInput = wrapper.querySelector(".form input");

generateBtn.addEventListener("click", () => {
    wrapper.classList.add("active");
});