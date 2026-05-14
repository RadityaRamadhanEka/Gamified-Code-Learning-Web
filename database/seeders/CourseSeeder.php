<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // COURSE 1: Frontend Master (Available from Level 0)
        // =====================================================================
        $frontend = Course::create([
            'title' => 'Frontend Master',
            'slug' => 'frontend-master',
            'description' => 'Pelajari cara membangun antarmuka web yang memukau dan interaktif dari nol menggunakan HTML, CSS modern, JavaScript, dan framework React.',
            'icon' => 'terminal',
            'color_theme' => 'primary',
            'min_level_required' => 0,
            'order' => 1,
        ]);

        // Module 1: HTML & CSS Foundation
        $mod1 = Module::create([
            'course_id' => $frontend->id,
            'title' => 'HTML & CSS Foundation',
            'description' => 'Dasar-dasar HTML semantik dan CSS modern untuk membangun struktur halaman web.',
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $mod1->id,
            'title' => 'Semantic HTML & SEO Basics',
            'slug' => 'semantic-html-seo',
            'content' => '<p>HTML (HyperText Markup Language) adalah fondasi dari setiap halaman web. Dengan HTML semantik, kita tidak hanya membuat struktur halaman yang valid, tetapi juga membantu mesin pencari memahami konten kita.</p>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">Elemen Semantik Utama</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>&lt;header&gt;   - Bagian atas halaman / section
&lt;nav&gt;      - Navigasi utama
&lt;main&gt;     - Konten utama halaman
&lt;article&gt;  - Konten mandiri (blog post, berita)
&lt;section&gt;  - Bagian tematik dari konten
&lt;aside&gt;    - Konten pelengkap (sidebar)
&lt;footer&gt;   - Bagian bawah halaman / section</code></pre>
<div class="bg-primary/10 border-l-4 border-primary p-4 rounded-r-lg mt-6">
    <div class="flex items-start gap-3">
        <span class="material-symbols-outlined text-primary mt-1">lightbulb</span>
        <p class="text-on-surface-variant text-sm m-0"><strong>Pro Tip:</strong> Gunakan tag semantik alih-alih <code>&lt;div&gt;</code> generik. Ini meningkatkan aksesibilitas dan SEO secara signifikan.</p>
    </div>
</div>',
            'xp_reward' => 50,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $mod1->id,
            'title' => 'CSS Flexbox & Grid Layout',
            'slug' => 'css-flexbox-grid',
            'content' => '<p>CSS Flexbox dan Grid adalah dua sistem layout modern yang revolusioner. Flexbox ideal untuk tata letak satu dimensi (baris ATAU kolom), sementara Grid sempurna untuk layout dua dimensi.</p>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">Flexbox Basics</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.item {
    flex: 1; /* Semua item berbagi ruang sama rata */
}</code></pre>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">CSS Grid</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

/* Responsive tanpa media query! */
.auto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}</code></pre>',
            'xp_reward' => 50,
            'order' => 2,
        ]);

        // Quiz for Module 1
        $quiz1 = Quiz::create([
            'module_id' => $mod1->id,
            'title' => 'Mini Quiz: HTML & CSS',
            'slug' => 'html-css',
            'xp_per_correct' => 25,
            'time_limit_seconds' => 300,
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Properti CSS manakah yang digunakan untuk mengatur jarak di dalam sebuah elemen, antara konten dan batas (border) elemen tersebut?',
            'options' => ['margin', 'padding', 'spacing', 'border-spacing'],
            'correct_answer' => 'padding',
            'order' => 1,
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Tag HTML manakah yang paling tepat digunakan untuk membungkus navigasi utama website?',
            'options' => ['<div class="nav">', '<navigation>', '<nav>', '<menu>'],
            'correct_answer' => '<nav>',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Properti CSS apa yang digunakan untuk membuat layout dua dimensi (baris DAN kolom)?',
            'options' => ['display: flex', 'display: grid', 'display: block', 'display: inline-flex'],
            'correct_answer' => 'display: grid',
            'order' => 3,
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Apa fungsi dari atribut "alt" pada tag <img>?',
            'options' => ['Mengatur ukuran gambar', 'Memberikan teks alternatif untuk aksesibilitas', 'Mengatur posisi gambar', 'Memberikan link ke gambar'],
            'correct_answer' => 'Memberikan teks alternatif untuk aksesibilitas',
            'order' => 4,
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Di Flexbox, properti apa yang digunakan untuk meratakan item secara vertikal?',
            'options' => ['justify-content', 'align-items', 'flex-direction', 'flex-wrap'],
            'correct_answer' => 'align-items',
            'order' => 5,
        ]);

        // Module 2: JavaScript DOM & UI Interactivity
        $mod2 = Module::create([
            'course_id' => $frontend->id,
            'title' => 'JavaScript DOM & UI Interactivity',
            'description' => 'Manipulasi DOM, event handling, dan membuat UI interaktif dengan JavaScript.',
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $mod2->id,
            'title' => 'Seleksi DOM & Manipulasi Elemen',
            'slug' => 'dom-selection',
            'content' => '<p>Document Object Model (DOM) adalah representasi terstruktur dari halaman HTML yang memungkinkan JavaScript mengakses dan memodifikasi setiap elemen.</p>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">Metode Seleksi DOM</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>// Seleksi tunggal
const header = document.getElementById("main-header");
const btn = document.querySelector(".btn-primary");

// Seleksi multiple
const cards = document.querySelectorAll(".card");
const items = document.getElementsByClassName("item");

// Manipulasi konten
header.textContent = "Hello World";
header.innerHTML = "&lt;span&gt;Hello&lt;/span&gt; World";

// Manipulasi style
btn.style.backgroundColor = "#00f0ff";
btn.classList.add("active");
btn.classList.toggle("hidden");</code></pre>',
            'xp_reward' => 50,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $mod2->id,
            'title' => 'Event Listeners & User Input',
            'slug' => 'event-listeners',
            'content' => '<p>Dalam pengembangan antarmuka web modern, interaktivitas adalah kunci. Pengguna mengharapkan halaman web merespons tindakan mereka secara real-time—baik itu saat mengklik tombol, mengetik di dalam form, atau sekadar menggeser kursor.</p>
<p>Di JavaScript, kita menggunakan metode <code>addEventListener()</code> untuk mendengarkan kejadian (events) tertentu pada elemen DOM dan mengeksekusi fungsi callback sebagai respons.</p>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">Sintaks Dasar</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>const button = document.querySelector("#myButton");

button.addEventListener("click", function(event) {
    console.log("Button clicked!", event);
    // Jalankan logika interaksi di sini
});</code></pre>
<p class="mt-4">Objek <code>event</code> menyimpan berbagai informasi penting tentang interaksi yang baru saja terjadi, seperti elemen target, posisi kursor, tombol keyboard yang ditekan, dan banyak lagi.</p>
<div class="bg-primary/10 border-l-4 border-primary p-4 rounded-r-lg mt-6">
    <div class="flex items-start gap-3">
        <span class="material-symbols-outlined text-primary mt-1">lightbulb</span>
        <p class="text-on-surface-variant text-sm m-0"><strong>Pro Tip:</strong> Selalu ingat untuk menghapus event listener dengan <code>removeEventListener</code> jika elemen tersebut akan dihapus dari DOM untuk mencegah <em>memory leak</em> pada aplikasi Single Page Application (SPA).</p>
    </div>
</div>',
            'xp_reward' => 50,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $mod2->id,
            'title' => 'Web Animations API & Transitions',
            'slug' => 'web-animations',
            'content' => '<p>Animasi membuat UI terasa hidup dan responsif. CSS Transitions dan Web Animations API adalah dua cara utama untuk menambahkan gerakan ke antarmuka web.</p>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">CSS Transitions</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>.button {
    transition: all 0.3s ease;
    transform: translateY(0);
}
.button:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}</code></pre>',
            'xp_reward' => 50,
            'order' => 3,
        ]);

        Lesson::create([
            'module_id' => $mod2->id,
            'title' => 'Fetch API & Menampilkan Data',
            'slug' => 'fetch-api',
            'content' => '<p>Fetch API memungkinkan kita mengambil data dari server tanpa me-reload halaman. Ini adalah dasar dari Single Page Application (SPA) modern.</p>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">Menggunakan Fetch</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>async function loadPosts() {
    const response = await fetch("https://api.example.com/posts");
    const data = await response.json();
    
    data.forEach(post => {
        const card = document.createElement("div");
        card.innerHTML = `&lt;h3&gt;${post.title}&lt;/h3&gt;`;
        container.appendChild(card);
    });
}</code></pre>',
            'xp_reward' => 50,
            'order' => 4,
        ]);

        // Module 3: Modern Frontend Framework (React)
        $mod3 = Module::create([
            'course_id' => $frontend->id,
            'title' => 'Modern Frontend Framework (React)',
            'description' => 'Membangun aplikasi web modern dengan React — komponen, state, dan routing.',
            'order' => 3,
        ]);

        Lesson::create([
            'module_id' => $mod3->id,
            'title' => 'React Components & JSX',
            'slug' => 'react-components',
            'content' => '<p>React menggunakan pendekatan berbasis komponen untuk membangun antarmuka. Setiap bagian UI adalah komponen yang dapat digunakan ulang.</p>
<h3 class="text-xl font-bold mt-8 mb-4 text-on-surface">Membuat Komponen</h3>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>function Welcome({ name }) {
    return (
        &lt;div className="card"&gt;
            &lt;h1&gt;Hello, {name}!&lt;/h1&gt;
        &lt;/div&gt;
    );
}</code></pre>',
            'xp_reward' => 50,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $mod3->id,
            'title' => 'State, Props & Context API',
            'slug' => 'state-props-context',
            'content' => '<p>State dan Props adalah dua konsep fundamental di React. Props adalah data yang dikirim dari komponen parent, sedangkan State adalah data internal yang dikelola komponen sendiri.</p>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>function Counter() {
    const [count, setCount] = useState(0);
    return (
        &lt;button onClick={() =&gt; setCount(count + 1)}&gt;
            Count: {count}
        &lt;/button&gt;
    );
}</code></pre>',
            'xp_reward' => 50,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $mod3->id,
            'title' => 'React Router & Single Page App',
            'slug' => 'react-router',
            'content' => '<p>React Router memungkinkan navigasi antar halaman tanpa reload browser. Ini menciptakan pengalaman Single Page Application (SPA) yang mulus.</p>
<pre class="bg-surface-container-lowest p-4 rounded-lg border border-white/5 overflow-x-auto text-primary/90 font-code-sm text-code-sm"><code>import { BrowserRouter, Routes, Route } from "react-router-dom";

function App() {
    return (
        &lt;BrowserRouter&gt;
            &lt;Routes&gt;
                &lt;Route path="/" element={&lt;Home /&gt;} /&gt;
                &lt;Route path="/about" element={&lt;About /&gt;} /&gt;
            &lt;/Routes&gt;
        &lt;/BrowserRouter&gt;
    );
}</code></pre>',
            'xp_reward' => 50,
            'order' => 3,
        ]);

        // =====================================================================
        // COURSE 2: Backend Architecture (Available from Level 0)
        // =====================================================================
        Course::create([
            'title' => 'Backend Architecture',
            'slug' => 'backend-architecture',
            'description' => 'Kuasai arsitektur server-side, database design, dan API development.',
            'icon' => 'dns',
            'color_theme' => 'secondary',
            'min_level_required' => 0,
            'order' => 2,
        ]);

        // =====================================================================
        // COURSE 3: Fullstack Voyager (Locked until Level 50)
        // =====================================================================
        Course::create([
            'title' => 'Fullstack Voyager',
            'slug' => 'fullstack-voyager',
            'description' => 'Gabungkan kekuatan frontend dan backend untuk membangun aplikasi web fullstack yang lengkap.',
            'icon' => 'rocket_launch',
            'color_theme' => 'tertiary',
            'min_level_required' => 50,
            'order' => 3,
        ]);
    }
}
