const connect_item = document.querySelector(".connect_item");
const forme = document.querySelector(".forme");
const close_btn = document.querySelector(".close-btn");

connect_item.addEventListener("click", () => {
  forme.style.display = "block";
});
close_btn.addEventListener("click", () => {
  forme.style.display = "none";
});

connect_item.addEventListener("keypress", (e) => {
  if (e.key === "Escape" || e.key === "q") {
    forme.style.display = "none";
  }
});
