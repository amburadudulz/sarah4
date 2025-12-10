// Helper
const $ = (s) => document.querySelector(s);
const $$ = (s) => document.querySelectorAll(s);

const rightPanel = $("#right-panel");

// === FADE ON SCROLL ===
const fadeObs = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
        if(e.isIntersecting){
            e.target.classList.add("show");
        }
    });
},{
    threshold:0.2
});

$$(".fade").forEach(el => fadeObs.observe(el));


// === AUTOSCROLL ===
let autoScroll = true;

function startAutoScroll(){
    if(!autoScroll) return;
    rightPanel.scrollTop += 0.6;
    requestAnimationFrame(startAutoScroll);
}

setTimeout(startAutoScroll, 1500);

rightPanel.addEventListener("wheel", ()=> autoScroll = false);
rightPanel.addEventListener("touchmove", ()=> autoScroll = false);


// === PARALLAX ===
rightPanel.addEventListener("scroll", ()=>{
    const y = rightPanel.scrollTop * 0.15;
    $$(".nature-right img").forEach(img=>{
        img.style.transform = `translateY(${y}px)`;
    });
});


// === LIGHTBOX GALERI ===
$$(".gallery-grid img").forEach(img=>{
    img.addEventListener("click", ()=>{
        const box = document.createElement("div");
        box.id = "lightbox";
        box.style.cssText = `
            position:fixed; inset:0; background:rgba(0,0,0,0.8);
            display:flex; align-items:center; justify-content:center;
            z-index:9999;
        `;
        box.innerHTML = `<img src="${img.src}" style="width:90%; max-width:600px; border-radius:10px;">`;
        box.onclick = ()=> box.remove();
        document.body.appendChild(box);
    });
});
