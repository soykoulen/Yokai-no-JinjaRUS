// assets/js/main.js

// Аудио менеджер
let currentAudio = null;

function setAmbient(soundType) {
    const audio = document.getElementById('ambient-sound');
    if (!audio) return;
    
    let soundFile = '';
    switch(soundType) {
        case 'crickets':
            soundFile = 'assets/sounds/crickets.mp3';
            break;
        case 'temple':
            soundFile = 'assets/sounds/temple.mp3';
            break;
        case 'forest':
            soundFile = 'assets/sounds/forest.mp3';
            break;
        case 'mystery':
            soundFile = 'assets/sounds/mystery.mp3';
            break;
        default:
            soundFile = 'assets/sounds/crickets.mp3';
    }
    
    if (currentAudio !== soundFile) {
        audio.src = soundFile;
        audio.volume = 0.3;
        audio.play().catch(e => console.log('Audio play prevented:', e));
        currentAudio = soundFile;
    }
}

// Создание партиклов
function createParticles() {
    const container = document.querySelector('.particles');
    if (!container) return;
    
    for (let i = 0; i < 50; i++) {
        const particle = document.createElement('div');
        particle.style.position = 'absolute';
        particle.style.width = '2px';
        particle.style.height = '2px';
        particle.style.backgroundColor = 'rgba(196, 167, 71, 0.5)';
        particle.style.borderRadius = '50%';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.animation = `floatParticle ${10 + Math.random() * 20}s linear infinite`;
        particle.style.animationDelay = Math.random() * 10 + 's';
        container.appendChild(particle);
    }
}

// Анимация партиклов
const style = document.createElement('style');
style.textContent = `
    @keyframes floatParticle {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 0.5;
        }
        90% {
            opacity: 0.5;
        }
        100% {
            transform: translateY(-100vh) translateX(${Math.random() * 100 - 50}px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Интерактивные врата
document.addEventListener('DOMContentLoaded', () => {
    createParticles();
    
    // Навигация через врата
    const gates = document.querySelectorAll('.gate');
    gates.forEach(gate => {
        gate.addEventListener('click', () => {
            const page = gate.dataset.page;
            if (page) {
                // Добавляем эффект затухания
                document.body.style.opacity = '0';
                setTimeout(() => {
                    window.location.href = page;
                }, 300);
            }
        });
    });
    
    // Анимация карточек
    const cards = document.querySelectorAll('.card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('slide-up');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    cards.forEach(card => observer.observe(card));
    
    // Параллакс для тумана
    document.addEventListener('mousemove', (e) => {
        const fog = document.querySelector('.fog-layer');
        if (fog) {
            const x = (e.clientX / window.innerWidth - 0.5) * 20;
            const y = (e.clientY / window.innerHeight - 0.5) * 10;
            fog.style.transform = `translate(${x}px, ${y}px) scale(1.05)`;
        }
    });
});

// Плавное появление контента
window.addEventListener('load', () => {
    document.body.style.opacity = '1';
    document.body.style.transition = 'opacity 0.3s ease';
    
    const main = document.querySelector('.main');
    if (main) {
        main.classList.add('fade-in');
    }
});

// Функция для обрезания текста
function truncateText(text, maxLength = 150) {
    if (!text) return '';
    if (text.length <= maxLength) return text;
    return text.substring(0, maxLength) + '...';
}

// Функция для экранирования HTML
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}