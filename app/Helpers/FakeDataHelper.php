<?php

namespace App\Helpers;

class FakeDataHelper
{
    // ==================== JOB RELATED ====================
    const JOB_LEVELS = [
        'Intern',
        'Junior',
        'Mid-Level',
        'Senior',
        'Team Leader',
        'Tech Lead',
        'Manager',
        'Senior Manager',
        'Director',
        'VP',
        'C-Level',
    ];

    const JOB_TYPES = [
        'Full-Time',
        'Part-Time',
        'Contract',
        'Freelance',
        'Internship',
    ];

    // ==================== TEAM RELATED ====================
    const TEAM_NAMES = [
        // Engineering & Tech
        'Engineering',
        'Frontend',
        'Backend',
        'Full Stack',
        'Mobile',
        'DevOps',
        'Platform',
        'Infrastructure',
        'Security',
        'QA & Testing',
        'Data Engineering',
        'AI & Machine Learning',
        'Research & Development',
        'Architecture',
        'Embedded Systems',

        // Product & Design
        'Product',
        'Product Management',
        'UX/UI Design',
        'Design Systems',
        'User Research',
        'Growth',

        // Data & Analytics
        'Data Science',
        'Data Analytics',
        'Business Intelligence',

        // Marketing & Sales
        'Marketing',
        'Content',
        'SEO',
        'Performance Marketing',
        'Brand',
        'Sales',
        'Business Development',
        'Partnerships',
        'Customer Success',
        'Account Management',

        // Operations
        'Operations',
        'IT Support',
        'IT Operations',
        'Project Management',
        'Strategy',
        'Supply Chain',
        'Logistics',

        // People & Admin
        'Human Resources',
        'Talent Acquisition',
        'People & Culture',
        'Learning & Development',
        'Administration',
        'Executive',

        // Finance & Legal
        'Finance',
        'Accounting',
        'Legal',
        'Compliance',
        'Risk Management',

        // Customer Facing
        'Customer Support',
        'Customer Experience',
        'Community',
        'Technical Support',

        // Other
        'Communications',
        'Public Relations',
        'Social Media',
        'Events',
        'Sustainability',
    ];

    // ==================== FUNDING RELATED ====================
    const FUNDING = [
        // Tier 1 VC
        'Sequoia Capital',
        'Andreessen Horowitz (a16z)',
        'Y Combinator',
        'Accel',
        'Kleiner Perkins',
        'Benchmark',
        'Index Ventures',
        'Founders Fund',
        'Tiger Global',
        'SoftBank Vision Fund',
        'General Catalyst',
        'Lightspeed Venture Partners',
        'NEA',
        'GV (Google Ventures)',
        'Intel Capital',
        'Insight Partners',

        // Corporate / Strategic
        'Microsoft',
        'Google',
        'Amazon',
        'Meta',
        'Salesforce Ventures',
        'Samsung Next',
        'Qualcomm Ventures',

        // Angel / Other
        'Angel Investor',
        'Family Office',
        'Crowdfunding Backers',
        'Government Grant',
        'University Fund',
    ];

    // ==================== INDUSTRY RELATED ====================
    const INDUSTRIES = [
        // Technology
        'Information Technology',
        'Software Development',
        'Artificial Intelligence',
        'Cybersecurity',
        'Cloud Computing',
        'Data Analytics',
        'Telecommunications',
        'Semiconductor & Electronics',
        'Internet of Things (IoT)',
        'Blockchain & Web3',
        'Gaming & Esports',
        'SaaS',
        'IT Consulting',

        // Finance & Business
        'Banking',
        'Insurance',
        'Investment Management',
        'Fintech',
        'Accounting',
        'Venture Capital & Private Equity',
        'Real Estate',
        'Management Consulting',

        // Healthcare & Life Sciences
        'Healthcare',
        'Pharmaceuticals',
        'Biotechnology',
        'Medical Devices',
        'Mental Health',
        'Health Insurance',
        'Telemedicine',

        // Education
        'Higher Education',
        'K-12 Education',
        'EdTech',
        'Corporate Training',
        'Online Learning',
        'Research & Development',

        // Manufacturing & Engineering
        'Manufacturing',
        'Automotive',
        'Aerospace & Defense',
        'Civil Engineering',
        'Chemical Engineering',
        'Robotics & Automation',
        'Construction',
        '3D Printing & Additive Manufacturing',

        // Energy & Environment
        'Oil & Gas',
        'Renewable Energy',
        'Nuclear Energy',
        'Utilities',
        'Environmental Services',
        'Waste Management',
        'Mining',

        // Retail & E-Commerce
        'Retail',
        'E-Commerce',
        'Fashion & Apparel',
        'Luxury Goods',
        'Consumer Electronics',
        'Food & Beverage',
        'Grocery',

        // Media & Entertainment
        'Film & Television',
        'Music',
        'Publishing',
        'Advertising & Marketing',
        'Public Relations',
        'Social Media',
        'Streaming Services',
        'Animation & VFX',

        // Transportation & Logistics
        'Logistics & Supply Chain',
        'Shipping & Maritime',
        'Airlines & Aviation',
        'Trucking & Freight',
        'Ride-Sharing & Mobility',
        'Warehousing',
        'Last-Mile Delivery',

        // Government & Nonprofit
        'Government',
        'Nonprofit & NGO',
        'International Development',
        'Public Policy',
        'Military & Defense',

        // Hospitality & Travel
        'Hotels & Resorts',
        'Travel & Tourism',
        'Restaurants & Food Service',
        'Event Management',
        'Cruise Lines',

        // Legal
        'Legal Services',
        'Compliance & Regulatory',
        'Intellectual Property',

        // Agriculture
        'Agriculture',
        'Agritech',
        'Forestry',
        'Fisheries & Aquaculture',

        // Sports & Fitness
        'Sports',
        'Fitness & Wellness',
        'Sports Technology',

        // Other
        'Human Resources',
        'Staffing & Recruiting',
        'Security Services',
        'Architecture & Design',
        'Interior Design',
        'Coworking & Shared Spaces',
        'Pet Care & Veterinary',
    ];

    // ==================== EDUCATION RELATED ====================
    const DEGREES = [
        // High School
        'High School Diploma',
        'GED',

        // Associate
        'Associate of Arts (AA)',
        'Associate of Science (AS)',

        // Bachelor
        'Bachelor of Arts (BA)',
        'Bachelor of Science (BS)',
        'Bachelor of Engineering (BEng)',
        'Bachelor of Business Administration (BBA)',
        'Bachelor of Computer Science (BCS)',

        // Master
        'Master of Arts (MA)',
        'Master of Science (MS)',
        'Master of Business Administration (MBA)',
        'Master of Engineering (MEng)',
        'Master of Education (MEd)',

        // Doctorate
        'Doctor of Philosophy (PhD)',
        'Doctor of Medicine (MD)',
        'Doctor of Education (EdD)',

        // Professional
        'Professional Certificate',
        'Diploma',
        'Bootcamp Certificate',
    ];

    const FIELDS_OF_STUDY = [
        // Technology
        'Computer Science',
        'Software Engineering',
        'Information Technology',
        'Cybersecurity',
        'Data Science',
        'Artificial Intelligence',
        'Web Development',

        // Business
        'Business Administration',
        'Marketing',
        'Finance',
        'Accounting',
        'Economics',
        'Management',

        // Engineering
        'Electrical Engineering',
        'Mechanical Engineering',
        'Civil Engineering',
        'Chemical Engineering',

        // Science
        'Mathematics',
        'Physics',
        'Biology',
        'Chemistry',

        // Arts & Humanities
        'Graphic Design',
        'Psychology',
        'Communication',
        'English Literature',
        'Philosophy',
    ];

    const SCHOOL_TYPES = [
        'University',
        'Institute of Technology',
        'College',
        'Community College',
        'Online Academy',
        'Bootcamp',
        'Polytechnic',
    ];

    const GRADES = [
        'A+',
        'A',
        'A-',
        'B+',
        'B',
        'B-',
        'C+',
        'C',
        'Pass',
        'Distinction',
        'Merit',
        '4.0 GPA',
        '3.9 GPA',
        '3.8 GPA',
        '3.5 GPA',
        '3.0 GPA',
    ];


    // ==================== ATTACHMENT RELATED ====================
    const ATTACHMENT_PATH = 'attachments/default-attachment.pdf';


    // ==================== SKILLS RELATED ====================

    const SKILLS = [
        // 🌐 Frontend Development
        'HTML',
        'CSS',
        'JavaScript',
        'TypeScript',
        'React.js',
        'Vue.js',
        'Angular',
        'Next.js',
        'Nuxt.js',
        'Svelte',
        'jQuery',
        'Bootstrap',
        'Tailwind CSS',
        'Material UI',
        'Sass/SCSS',
        'Less',
        'Webpack',
        'Vite',
        'Babel',

        // ⚙️ Backend Development
        'PHP',
        'Laravel',
        'Symfony',
        'CodeIgniter',
        'Python',
        'Django',
        'Flask',
        'FastAPI',
        'Node.js',
        'Express.js',
        'NestJS',
        'Ruby',
        'Ruby on Rails',
        'Java',
        'Spring Boot',
        'Kotlin',
        'Go (Golang)',
        'Rust',
        'C',
        'C++',
        'C#',
        '.NET',
        'ASP.NET',
        'Scala',
        'Elixir',
        'Phoenix',
        'Perl',

        // 📱 Mobile Development
        'React Native',
        'Flutter',
        'Dart',
        'Swift',
        'Objective-C',
        'Android Development',
        'iOS Development',
        'Kotlin Multiplatform',
        'Ionic',
        'Xamarin',

        // 🗄️ Database
        'MySQL',
        'PostgreSQL',
        'SQLite',
        'Microsoft SQL Server',
        'Oracle Database',
        'MongoDB',
        'Redis',
        'Cassandra',
        'DynamoDB',
        'Firebase',
        'Supabase',
        'Elasticsearch',
        'MariaDB',
        'CouchDB',
        'Neo4j',

        // ☁️ Cloud & DevOps
        'AWS',
        'Google Cloud Platform (GCP)',
        'Microsoft Azure',
        'Docker',
        'Kubernetes',
        'Terraform',
        'Ansible',
        'Jenkins',
        'GitHub Actions',
        'GitLab CI/CD',
        'CircleCI',
        'Travis CI',
        'Nginx',
        'Apache',
        'Linux',
        'Ubuntu',
        'Bash Scripting',
        'PowerShell',
        'Vagrant',

        // 🔒 Cybersecurity
        'Network Security',
        'Penetration Testing',
        'Ethical Hacking',
        'Cryptography',
        'Firewall Management',
        'OWASP',
        'SSL/TLS',
        'OAuth',
        'JWT',
        'SIEM',
        'Vulnerability Assessment',
        'Incident Response',
        'Malware Analysis',
        'Digital Forensics',
        'Zero Trust Security',

        // 🤖 AI & Machine Learning
        'Machine Learning',
        'Deep Learning',
        'Natural Language Processing (NLP)',
        'Computer Vision',
        'TensorFlow',
        'PyTorch',
        'Keras',
        'Scikit-learn',
        'OpenCV',
        'Pandas',
        'NumPy',
        'Matplotlib',
        'Hugging Face',
        'LangChain',
        'Reinforcement Learning',
        'Neural Networks',
        'Data Mining',
        'Feature Engineering',

        // 📊 Data Science & Analytics
        'Data Analysis',
        'Data Visualization',
        'Business Intelligence',
        'Power BI',
        'Tableau',
        'Google Analytics',
        'Apache Spark',
        'Hadoop',
        'Kafka',
        'Airflow',
        'dbt',
        'Looker',
        'R Programming',
        'MATLAB',
        'Statistics',
        'A/B Testing',

        // 🔗 Blockchain & Web3
        'Blockchain',
        'Solidity',
        'Ethereum',
        'Smart Contracts',
        'Web3.js',
        'Hardhat',
        'Truffle',
        'IPFS',
        'DeFi',
        'NFT Development',

        // 🎮 Game Development
        'Unity',
        'Unreal Engine',
        'C# (Game Dev)',
        'Blender',
        'OpenGL',
        'DirectX',
        'Godot',
        'WebGL',
        'Three.js',
        'AR Development',
        'VR Development',

        // 🛠️ Tools & Practices
        'Git',
        'GitHub',
        'GitLab',
        'Bitbucket',
        'Jira',
        'Confluence',
        'Postman',
        'Swagger',
        'REST API',
        'GraphQL',
        'gRPC',
        'WebSockets',
        'Microservices',
        'Agile',
        'Scrum',
        'Kanban',
        'TDD (Test Driven Development)',
        'CI/CD',
        'System Design',

        // 🧪 Testing
        'Unit Testing',
        'Integration Testing',
        'End-to-End Testing',
        'Jest',
        'PHPUnit',
        'Pytest',
        'Cypress',
        'Selenium',
        'Playwright',
        'Mocha',
        'Chai',

        // 🖥️ Operating Systems
        'Windows Server',
        'macOS',
        'Linux Administration',
        'Debian',
        'CentOS',
        'Red Hat',
        'FreeBSD',

        // 🌐 Networking
        'TCP/IP',
        'DNS',
        'HTTP/HTTPS',
        'FTP',
        'VPN',
        'Load Balancing',
        'CDN',
        'Proxy Servers',
        'Network Administration',
        'Cisco Networking',

        // 🎨 UI/UX Design
        'Figma',
        'Adobe XD',
        'Sketch',
        'InVision',
        'UI Design',
        'UX Design',
        'Wireframing',
        'Prototyping',
        'User Research',
        'Design Systems',
        'Accessibility (a11y)',

        // 📦 CMS & E-Commerce
        'WordPress',
        'Shopify',
        'Magento',
        'WooCommerce',
        'Drupal',
        'Joomla',
        'Strapi',
        'Contentful',
        'Sanity',

        // 📡 IoT & Embedded Systems
        'IoT Development',
        'Arduino',
        'Raspberry Pi',
        'Embedded C',
        'MQTT',
        'Zigbee',
        'Edge Computing',
        'RTOS',
        'Assembly Language',

        // 🏗️ Software Architecture
        'Design Patterns',
        'SOLID Principles',
        'Domain Driven Design (DDD)',
        'Event Driven Architecture',
        'Serverless Architecture',
        'Clean Architecture',
        'Monolithic Architecture',
        'SOA (Service Oriented Architecture)',
    ];

    const HEROICONS = [
        // Mission & Vision
        'cursor-arrow-rays',      // bullseye/target
        'rocket-launch',
        'light-bulb',
        'eye',
        'flag',
        'sparkles',

        // People & Team
        'users',
        'user-group',
        'hand-raised',
        'user-circle',
        'heart',
        'hand-thumb-up',

        // Growth & Innovation
        'chart-bar',
        'arrow-trending-up',
        'presentation-chart-line',
        'cpu-chip',
        'beaker',
        'puzzle-piece',
        'cube-transparent',

        // Globe & Impact
        'globe-alt',
        'globe-americas',
        'heart',
        'gift',
        'sun',

        // Quality & Trust
        'shield-check',
        'star',
        'trophy',
        'check-badge',
        'academic-cap',
        'bookmark',

        // Communication & Transparency
        'chat-bubble-left-right',
        'megaphone',
        'share',
        'signal',
        'envelope',
        'inbox',

        // Work & Productivity
        'briefcase',
        'cog-6-tooth',
        'wrench-screwdriver',
        'cube',
        'squares-2x2',
        'bolt',
        'command-line',
        'document-check',

        // Balance & Wellness
        'scale',
        'face-smile',
        'moon',
        'cloud',
        'fire',
        'home',
        'building-office',

        // Additional Useful Icons
        'lock-closed',
        'key',
        'clock',
        'calendar',
        'map-pin',
        'phone',
        'currency-dollar',
        'banknotes',
        'credit-card',
        'identification',
        'magnifying-glass',
        'adjustments-horizontal',
    ];
}
