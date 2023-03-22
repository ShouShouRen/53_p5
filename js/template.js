const template1 = document.querySelector("#template1");
const template2 = document.querySelector("#template2");
const template3 = document.querySelector("#template3");
const template4 = document.querySelector("#template4");
const preview = document.querySelector("#preview");

const form = document.querySelector("form");
const product_name = document.querySelector("input[name='product_name']");
const product_des = document.querySelector('textarea[name="product_des"]');
const time = document.querySelector("input[name='time']");
const images = document.querySelector("input[name='images']");
const price = document.querySelector("input[name='price']");
const links = document.querySelector("input[name='links']");
const previewtab = document.querySelector("#preview-tab");

const template1HTML = `
<div class="row pt-5 mt-5 justify-content-center">
  <div class="col-6 d-flex h-380">
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center"></div>
      <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
    </div>
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-20 mt-1 py-3">商品名稱</div>
      <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
      <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
      <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
    </div>
  </div>
</div>
`;
const template2HTML = `
<div class="row pt-5 mt-5 justify-content-center">
  <div class="col-6 d-flex h-380">
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center"></div>
      <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
    </div>
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-20 mt-1 py-3">商品名稱</div>
      <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
      <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
      <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
    </div>
  </div>
</div>
`;
const template3HTML = `
<div class="row pt-5 mt-5 justify-content-center">
  <div class="col-6 d-flex h-380">
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center"></div>
      <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
    </div>
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-20 mt-1 py-3">商品名稱</div>
      <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
      <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
      <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
    </div>
  </div>
</div>
`;
const template4HTML = `
<div class="row pt-5 mt-5 justify-content-center">
  <div class="col-6 d-flex h-380">
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center"></div>
      <div class="bg-2 w-100 h-20 mt-1 py-3">相關連結</div>
    </div>
    <div class="col-6 h-100 bg-back p-3 text-center text-light">
      <div class="bg-1 w-100 h-20 mt-1 py-3">商品名稱</div>
      <div class="bg-2 w-100 h-30 mt-1 py-4">商品簡介</div>
      <div class="bg-3 w-100 h-20 mt-1 py-3">發布日期</div>
      <div class="bg-1 w-100 h-20 mt-1 py-3">費用</div>
    </div>
  </div>
</div>
`;

const gettemplates = [
  { el: template1, html: template1HTML },
  { el: template2, html: template2HTML },
  { el: template3, html: template3HTML },
  { el: template4, html: template4HTML },
];
gettemplates.forEach((gettemplate) => {
  gettemplate.el.addEventListener("change", () => {
    if (gettemplate.el.checked) {
      preview.innerHTML = gettemplate.html;
    }
  });
});

const templates = [
  { el: template1, html: template1HTML },
  { el: template2, html: template2HTML },
  { el: template3, html: template3HTML },
  { el: template4, html: template4HTML },
];

previewtab.addEventListener("click", (e) => {
  e.preventDefault();
  const file = images.files[0];
  const reader = new FileReader();
  reader.onload = () => {
    templates.forEach((template) => {
      if (template.el.checked) {
        const previewHTML = template.html
          .replace("商品名稱", "商品名稱：" + product_name.value)
          .replace("商品簡介", "商品簡介:" + product_des.value)
          .replace("發布日期", "發布日期:" + time.value)
          .replace("費用", "費用" + price.value)
          .replace(
            '<div class="bg-1 w-100 h-75 d-flex justify-content-center align-items-center"></div>',
            `<img src="${reader.result}" class="w-100 h-75">`
          )
          .replace("相關連結", "相關連結" + `<a class="pl-2" href="${links.value}">${links.value}</a>`);
        preview.innerHTML = previewHTML;
      }
    });
  };
  reader.readAsDataURL(file);
});
