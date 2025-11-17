@extends('layouts.pages')

@section('title', 'About')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- About Header -->
        <section class="about-header">
            <h1 class="about-title">
                About <span class="highlight">Me</span>
            </h1>
            <p class="about-subtitle">
                Built on belief and shaped through code. This is the path I've taken, and the trace I continue
                leaving.
            </p>
        </section>

        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <a href="#intro" class="tab-item active" data-tab="intro">Intro</a>
            <a href="#experiences" class="tab-item" data-tab="experiences">Experiences</a>
            <a href="#educations" class="tab-item" data-tab="educations">Educations</a>
            <a href="#certifications" class="tab-item" data-tab="certifications">Certifications</a>
        </div>

        <!-- Intro Section -->
        <div class="content-section" id="intro-section">
            <!-- CV Download -->
            <div class="cv-section">
                <div class="cv-header">
                    <i class="bi bi-file-earmark-text cv-icon"></i>
                    <h3 class="cv-title">Curriculum Vitae</h3>
                </div>
                <p class="cv-subtitle">Access my CV in different formats</p>
                <div class="cv-note">
                    <i class="bi bi-info-circle"></i>
                    <span>View in PDF, Word format, or get the editable template</span>
                </div>
                <div class="cv-buttons">
                    <a href="#" class="btn btn-outline">
                        <i class="bi bi-file-pdf"></i>
                        <span>PDF</span>
                    </a>
                    <a href="#" class="btn btn-outline">
                        <i class="bi bi-file-word"></i>
                        <span>Latest (Word)</span>
                    </a>
                    <a href="#" class="btn btn-outline">
                        <i class="bi bi-files"></i>
                        <span>Copy CV</span>
                    </a>
                </div>
            </div>

            <!-- Introduction -->
            <div class="content-card">
                <div class="status-tag">
                    <i class="bi bi-circle-fill"></i>
                    <span>Currently Open to Work</span>
                </div>
                <h2 class="content-title">Assalamu'alaikum</h2>
                <p class="content-text">
                    I am Ananda, known as anandairfansyah. A Python developer with hands-on experience in machine
                    learning and web development from Central Java, Indonesia. I lead Copilot ID, my creative hub
                    for building intelligent systems and web applications with Django, Flask, and ML tools with
                    PyTorch and TensorFlow, crafting each project with purpose.
                </p>
                <p class="content-text">
                    Outside of tech, I've been on a spiritual journey that shaped how I think and work. I've
                    memorized nearly 30 Juz of the Quran, a path that taught me discipline, clarity, and resilience.
                    These qualities naturally influence how I approach coding and mentorship.
                </p>
                <p class="content-text">
                    In my professional experience, I've mentored over 50 aspiring developers through DBS
                    Foundation's Coding Camp, helping them grow in Python and soft skills. At GAOTek Inc., I
                    supported more than 100 interns as they took their first steps into the tech world. So far, I've
                    completed over 40 projects, ranging from AI models to full-stack web apps.
                </p>
                <p class="content-text">
                    My academic journey began at Al Mukmin Islamic Boarding School, where I focused on Islamic
                    studies. Later, I earned a bachelor's degree in informatics with a concentration in Intelligent
                    Systems (AI) from the University of Technology Yogyakarta, graduating with a GPA of 3.58.
                </p>
                <p class="content-text">
                    I stay sharply focused on both AI advancements and Indonesia's financial market—especially
                    IHSG—to stay ahead in tech, achieve financial freedom as soon as possible, and enjoy the fruits
                    of my work in retirement.
                </p>
                <p class="content-text">
                    Looking forward, my vision is to elevate Copilot ID, contribute meaningfully to open-source
                    communities, and harness AI to address impactful challenges with precision and integrity. I am
                    committed to fostering innovation that drives sustainable progress.
                </p>
                <p class="content-text">
                    If you have a visionary idea or wish to explore the possibilities of technology, I'd be
                    delighted to connect and create something transformative together. 🚀
                </p>
                <h3 class="content-closing">Wassalamu'alaikum!</h3>
            </div>
        </div>

        <!-- Experiences Section -->
        <div class="content-section" id="experiences-section" style="display: none;">
            <!-- Experience 1: Copilot ID -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="Copilot ID" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">
                            Copilot ID
                            <i class="bi bi-box-arrow-up-right timeline-link"></i>
                        </div>
                        <div class="timeline-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>1 position</span>
                        </div>
                    </div>
                </div>
                <div class="timeline-role">
                    Founder (Personal Projects)
                    <span class="timeline-badge">
                        <i class="bi bi-circle-fill"></i>
                        Current
                    </span>
                </div>
                <div class="timeline-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Jan 2023 - Present
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-briefcase"></i>
                        Self-employed
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-laptop"></i>
                        On-site · Boyolali, Indonesia
                    </span>
                </div>
                <button class="achievements-toggle" onclick="toggleAchievements(this)">
                    <i class="bi bi-chevron-down"></i>
                    <span>Show Achievements</span>
                </button>
                <div class="achievements-list">
                    <div class="achievement-item">Collaborative Python Innovations and Learning for Optimal
                        Technologies.</div>
                    <div class="achievement-item">Averaging 15.66k unique visitors, 262.07k total requests, and 33k
                        active users over 30 days, with 161+ GitHub stars across public repositories.</div>
                    <div class="achievement-item">Executed AI-driven projects using Django, TensorFlow, PyTorch, and
                        modern web technologies.</div>
                    <div class="achievement-item">Leveraged vast experience across 15+ full-cycle projects including
                        MTV architecture, ORM, REST APIs, authentication, testing, and debugging.</div>
                    <div class="achievement-item">Built and deployed 11 Flask-based applications with scalable
                        routing and Jinja2 templating.</div>
                    <div class="achievement-item">Developed 81 end-to-end neural network systems involving
                        preprocessing, feature engineering, model tuning, evaluation, distributed training, and
                        deployment.</div>
                    <div class="achievement-item">Applied a broad tech stack: Python, PHP, JavaScript, Netlify,
                        Django, Flask, React, Next.js, Node.js, WordPress, MaterialUI, Tailwindcss, Laravel,
                        TensorFlow, PyGame, Keras, Scikit-learn, HTML/CSS, SQL, NoSQL, GitHub, DBF, Postman,
                        GraphQL, and Cloudflare.</div>
                </div>
            </div>

            <!-- Experience 2: IKA-PPIM 2021 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="IKA-PPIM 2021" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">
                            IKA-PPIM 2021
                            <i class="bi bi-box-arrow-up-right timeline-link"></i>
                        </div>
                        <div class="timeline-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>1 position</span>
                        </div>
                    </div>
                </div>
                <div class="timeline-role">
                    Chief Secretary
                    <span class="timeline-badge">
                        <i class="bi bi-circle-fill"></i>
                        Current
                    </span>
                </div>
                <div class="timeline-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Sep 2021 - Present
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-briefcase"></i>
                        Part-time
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-laptop"></i>
                        Remote · Surakarta, Indonesia
                    </span>
                </div>
            </div>

            <!-- Experience 3: Coding Camp -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="DBS Foundation" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">
                            Coding Camp powered by DBS Foundation
                            <i class="bi bi-box-arrow-up-right timeline-link"></i>
                        </div>
                        <div class="timeline-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>5 positions</span>
                        </div>
                    </div>
                </div>
                <div class="timeline-role">Machine Learning Mentor</div>
                <div class="timeline-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Feb 2025 - Jul 2025
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-briefcase"></i>
                        Part-time
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-laptop"></i>
                        Remote · Bandung, Indonesia
                    </span>
                </div>
                <div class="timeline-divider"></div>
                <div class="timeline-role">Machine Learning Ops Cohort</div>
                <div class="timeline-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Dec 2024 - Jun 2025
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-award"></i>
                        Scholarship
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-laptop"></i>
                        Remote · Bandung, Indonesia
                    </span>
                </div>
                <div class="timeline-divider"></div>
                <div class="timeline-role">Machine Learning Expert Cohort</div>
                <div class="timeline-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Oct 2024 - Dec 2024
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-award"></i>
                        Scholarship
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-laptop"></i>
                        Remote · Bandung, Indonesia
                    </span>
                </div>
                <div class="timeline-divider"></div>
                <div class="timeline-role">Machine Learning Intermediate Cohort</div>
                <div class="timeline-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Jul 2024 - Sep 2024
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-award"></i>
                        Scholarship
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-laptop"></i>
                        Remote · Bandung, Indonesia
                    </span>
                </div>
                <div class="timeline-divider"></div>
                <div class="timeline-role">Machine Learning Beginner Cohort</div>
                <div class="timeline-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Jan 2024 - Jun 2024
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-award"></i>
                        Scholarship
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-laptop"></i>
                        Remote · Bandung, Indonesia
                    </span>
                </div>
            </div>

            <!-- Add more experiences as needed -->
        </div>

        <!-- Educations Section -->
        <div class="content-section" id="educations-section" style="display: none;">
            <!-- Education 1 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="UTY" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Informatics in Intelligence Systems (S.Kom.)</div>
                        <div class="timeline-company">Universitas Teknologi Yogyakarta</div>
                        <div class="timeline-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>Sleman, Special Region of Yogyakarta</span>
                        </div>
                    </div>
                    <div class="timeline-date">Sep 2021 - Aug 2025</div>
                </div>
                <button class="achievements-toggle" onclick="toggleAchievements(this)">
                    <i class="bi bi-chevron-down"></i>
                    <span>Show Achievements</span>
                </button>
                <div class="achievements-list">
                    <div class="achievement-item">Established foundational proficiency in algorithms and
                        object-oriented programming.</div>
                    <div class="achievement-item">Developed interactive web applications through hands-on coursework
                        and practical implementation.</div>
                    <div class="achievement-item">Analyzed large datasets and applied data analytics techniques to
                        derive actionable insights.</div>
                    <div class="achievement-item">Enhanced understanding of Machine Learning concepts and gained
                        exposure to Augmented Reality technologies.</div>
                    <div class="achievement-item">Mastered core concepts of data structures, algorithms, and neural
                        networks through applied projects.</div>
                </div>
            </div>

            <!-- Education 2 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="MAN" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Senior High School (Natural Science)</div>
                        <div class="timeline-company">MAS Al Mukmin Ngruki</div>
                        <div class="timeline-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>Surakarta, Central Java</span>
                        </div>
                    </div>
                    <div class="timeline-date">2018 - 2021</div>
                </div>
                <button class="achievements-toggle" onclick="toggleAchievements(this)">
                    <i class="bi bi-chevron-down"></i>
                    <span>Show Achievements</span>
                </button>
                <div class="achievements-list">
                    <div class="achievement-item">Focused on Natural Science curriculum with emphasis on
                        Mathematics, Physics, Chemistry, and Biology.</div>
                    <div class="achievement-item">Integrated Islamic studies with modern education methodology.
                    </div>
                    <div class="achievement-item">Developed strong analytical and problem-solving skills through
                        science-based projects.</div>
                </div>
            </div>

            <!-- Add more educations as needed -->
        </div>

        <!-- Certifications Section -->
        <div class="content-section" id="certifications-section" style="display: none;">
            <div class="cv-section">
                <div class="cv-header">
                    <i class="bi bi-linkedin cv-icon"></i>
                    <h3 class="cv-title">View All 115+ Certifications</h3>
                </div>
                <p class="cv-subtitle">See my complete certification portfolio on LinkedIn</p>
                <div class="cv-buttons">
                    <a href="#" class="btn btn-outline" target="_blank">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View on LinkedIn</span>
                    </a>
                </div>
            </div>

            <!-- Certification 1 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="DBS" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Certificate of Appreciation for Machine Learning Mentoring</div>
                        <div class="timeline-company">Coding Camp powered by DBS Foundation</div>
                    </div>
                    <div class="timeline-date">Jul 2025</div>
                </div>
                <div class="credential-actions">
                    <button class="achievements-toggle" onclick="toggleAchievements(this)">
                        <i class="bi bi-chevron-down"></i>
                        <span>Show Achievements</span>
                    </button>
                    <a href="#" class="btn btn-outline achievements-toggle">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Credential</span>
                    </a>
                </div>
                <div class="achievements-list">
                    <div class="achievement-item">Led weekly mentoring for 24 students, achieving a 75% graduation
                        rate with consistent 84% attendance.</div>
                    <div class="achievement-item">Designed and delivered alternating sessions on soft and technical
                        skills (2 hours/week) for 50 participants.</div>
                    <div class="achievement-item">Managed end-to-end facilitation, including content preparation,
                        moderator coordination, and cohort engagement tracking.</div>
                </div>
            </div>

            <!-- Certification 2 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="LinkedIn" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Crafting REST APIs with Django</div>
                        <div class="timeline-company">LinkedIn Learning</div>
                    </div>
                    <div class="timeline-date">Dec 2024</div>
                </div>
                <div class="credential-actions">
                    <button class="achievements-toggle" onclick="toggleAchievements(this)">
                        <i class="bi bi-chevron-down"></i>
                        <span>Show Achievements</span>
                    </button>
                    <a href="#" class="btn btn-outline achievements-toggle">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Credential</span>
                    </a>
                </div>
                <div class="achievements-list">
                    <div class="achievement-item">Mastered Django REST Framework for building scalable APIs.</div>
                    <div class="achievement-item">Implemented authentication, serialization, and API versioning best
                        practices.</div>
                </div>
            </div>

            <!-- Certification 3 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="Dicoding" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Applied Machine Learning</div>
                        <div class="timeline-company">Dicoding Indonesia</div>
                    </div>
                    <div class="timeline-date">Dec 2024</div>
                </div>
                <div class="credential-actions">
                    <button class="achievements-toggle" onclick="toggleAchievements(this)">
                        <i class="bi bi-chevron-down"></i>
                        <span>Show Achievements</span>
                    </button>
                    <a href="#" class="btn btn-outline achievements-toggle">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Credential</span>
                    </a>
                </div>
                <div class="achievements-list">
                    <div class="achievement-item">Deep learning with TensorFlow and Keras frameworks.</div>
                    <div class="achievement-item">Computer vision and natural language processing implementations.
                    </div>
                </div>
            </div>

            <!-- Certification 4 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="Dicoding" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Learning Data Analysis with Python</div>
                        <div class="timeline-company">Dicoding Indonesia</div>
                    </div>
                    <div class="timeline-date">Nov 2024</div>
                </div>
                <div class="credential-actions">
                    <button class="achievements-toggle" onclick="toggleAchievements(this)">
                        <i class="bi bi-chevron-down"></i>
                        <span>Show Achievements</span>
                    </button>
                    <a href="#" class="btn btn-outline achievements-toggle">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Credential</span>
                    </a>
                </div>
                <div class="achievements-list">
                    <div class="achievement-item">Data manipulation with Pandas and NumPy libraries.</div>
                    <div class="achievement-item">Data visualization with Matplotlib and Seaborn.</div>
                </div>
            </div>

            <!-- Certification 5 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="LinkedIn" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Building a Portfolio with Django</div>
                        <div class="timeline-company">LinkedIn Learning</div>
                    </div>
                    <div class="timeline-date">Oct 2023</div>
                </div>
                <div class="credential-actions">
                    <button class="achievements-toggle" onclick="toggleAchievements(this)">
                        <i class="bi bi-chevron-down"></i>
                        <span>Show Achievements</span>
                    </button>
                    <a href="#" class="btn btn-outline achievements-toggle">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Credential</span>
                    </a>
                </div>
                <div class="achievements-list">
                    <div class="achievement-item">Built portfolio website using Django framework.</div>
                    <div class="achievement-item">Implemented models, views, and templates architecture.</div>
                </div>
            </div>

            <!-- Certification 6 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="RapidMiner" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Machine Learning Professional Certification</div>
                        <div class="timeline-company">Altair RapidMiner</div>
                    </div>
                    <div class="timeline-date">Jun 2023</div>
                </div>
                <div class="credential-actions">
                    <button class="achievements-toggle" onclick="toggleAchievements(this)">
                        <i class="bi bi-chevron-down"></i>
                        <span>Show Achievements</span>
                    </button>
                    <a href="#" class="btn btn-outline achievements-toggle">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Credential</span>
                    </a>
                </div>
                <div class="achievements-list">
                    <div class="achievement-item">Professional certification in machine learning methodologies.
                    </div>
                    <div class="achievement-item">Advanced model building and evaluation techniques.</div>
                </div>
            </div>

            <!-- Certification 7 -->
            <div class="timeline-item">
                <div class="timeline-header">
                    <img src="" alt="RapidMiner" class="timeline-logo">
                    <div class="timeline-info">
                        <div class="timeline-title">Data Engineering Professional Certification</div>
                        <div class="timeline-company">Altair RapidMiner</div>
                    </div>
                    <div class="timeline-date">Jan 2023</div>
                </div>
                <div class="credential-actions">
                    <button class="achievements-toggle" onclick="toggleAchievements(this)">
                        <i class="bi bi-chevron-down"></i>
                        <span>Show Achievements</span>
                    </button>
                    <a href="#" class="btn btn-outline achievements-toggle">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>View Credential</span>
                    </a>
                </div>
                <div class="achievements-list">
                    <div class="achievement-item">Professional certification in data engineering practices.</div>
                    <div class="achievement-item">Data pipeline design and ETL processes.</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
@endpush

@push('scripts')
@endpush
