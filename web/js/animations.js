window.addEventListener('scroll', animOnScroll);

function animOnScroll() {
    for (let index = 0; index < animItems.length; index++) {
        const animItem = animItems[index];
        const animItemHeight = animItem.offsetHeight;
        const animItemOffset = offset(animItem).top;
        const animStart = 1;

        let animItemPoint = window.innerHeight - animItemHeight / animStart;
        if (animItemHeight > window.innerHeight) {
            animItemPoint = window.innerHeight - window.innerHeight / animStart;
        }

        let bottomOffset = animItem.hasAttribute('data-offset') ? parseInt(animItem.getAttribute('data-offset')) : 70;

        if (window.scrollY > animItemOffset - animItemPoint + bottomOffset && window.scrollY < animItemOffset + animItemHeight) {
            animItem.classList.add('visible');
        } else {
            // animItem.classList.remove('visible');
        }
    }
}

function offset(el) {
    const rect = el.getBoundingClientRect();
    const scrollLeft = window.scrollX || document.documentElement.scrollLeft;
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft };
}

const animItems = document.querySelectorAll('.animate');

animOnScroll();