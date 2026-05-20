<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Startup;
use App\Models\Corporate;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create demo users
        $demoUsers = [
            ['Demo Startup', 'demo.startup@innoventure.com', 'startup'],
            ['Demo Corporate', 'demo.corporate@innoventure.com', 'corporate'],
            ['Demo Investor', 'demo.investor@innoventure.com', 'investor'],
            ['Demo Admin', 'demo.admin@innoventure.com', 'admin'],
        ];

        $createdUsers = [];
        foreach ($demoUsers as $u) {
            $user = User::firstOrCreate(['email' => $u[1]], [
                'name' => $u[0],
                'email' => $u[1],
                'password' => Hash::make('demo123456'),
                'role' => $u[2],
                'is_active' => true,
                'is_verified' => true,
                'kyc_status' => 'verified',
                'company_verified' => true,
                'profile_complete' => true,
            ]);
            $createdUsers[$u[2]] = $user;
        }

        // Seed Startups
        $startups = [
            ['TechNova AI', 'Revolutionizing enterprise automation with next-gen AI', 'AI/ML', 'Series A', 'Building scalable AI infrastructure that reduces operational costs by 60% for mid-market enterprises.', 'Enterprise AI Platform', 'SaaS Subscription', 12, 2021, 'Bangalore, India', ['Python', 'TensorFlow', 'React', 'AWS', 'MongoDB'], 8200000, 15, 1200, true, false, 92, true],
            ['GreenPath Energy', 'Clean energy for Bharat\'s tier-2 cities', 'CleanTech', 'Seed', 'Deploying solar microgrids in underserved communities, providing affordable clean energy to 50,000+ households.', 'Energy Access Gap', 'Subscription + Pay-per-use', 8, 2022, 'Pune, India', ['IoT', 'React Native', 'Node.js', 'AWS IoT'], 1500000, 25, 320, true, true, 87, true],
            ['HealthSync Pro', 'AI diagnostics for remote India', 'HealthTech', 'Series B', 'End-to-end digital health platform connecting patients in rural areas with AI-assisted diagnostics and specialist consultations.', 'Healthcare Access', 'B2B + B2C Hybrid', 45, 2019, 'Hyderabad, India', ['React', 'Python', 'FastAPI', 'PostgreSQL', 'DICOM'], 22000000, 35, 85000, false, false, 81, true],
            ['EduVerse', 'Gamified K-12 learning platform', 'EdTech', 'Seed', 'Making quality education accessible and engaging through game-based learning with AI-personalized curriculum.', 'Poor Learning Outcomes', 'Freemium', 20, 2021, 'Delhi, India', ['React', 'Node.js', 'Unity', 'Firebase', 'MongoDB'], 3000000, 18, 45000, false, true, 76, false],
            ['FinBridge', 'Neo-banking for India\'s gig economy', 'FinTech', 'Series A', 'Full-stack financial services platform for India\'s 150M+ gig workers — banking, insurance, credit and investments.', 'Financial Exclusion', 'Transaction Fee + Subscription', 65, 2020, 'Mumbai, India', ['React Native', 'Go', 'PostgreSQL', 'Redis', 'Kafka'], 12000000, 22, 280000, true, false, 89, true],
            ['AgroBot', 'AI-powered precision farming', 'AgriTech', 'Pre-Seed', 'Using computer vision and IoT sensors to help smallholder farmers optimize crop yield and reduce pesticide use by 40%.', 'Low Farm Productivity', 'Hardware + SaaS', 6, 2023, 'Ahmedabad, India', ['Python', 'CV', 'IoT', 'React', 'Raspberry Pi'], 600000, 80, 850, true, false, 74, false],
            ['CyberShield', 'Zero-trust security for SMBs', 'Cybersecurity', 'Series A', 'Affordable enterprise-grade cybersecurity for small and mid-sized businesses using AI-powered threat detection.', 'Cyber Threats for SMBs', 'SaaS Subscription', 30, 2020, 'Bangalore, India', ['Go', 'Rust', 'React', 'AWS', 'Elasticsearch'], 9500000, 12, 1800, true, false, 85, true],
            ['LegalMate', 'AI-powered legal assistant', 'LegalTech', 'Seed', 'Democratizing legal access in India through AI-powered contract review, compliance tracking and legal document generation.', 'Legal Access Gap', 'API Monetization', 15, 2022, 'Chennai, India', ['Python', 'LLM', 'React', 'MongoDB', 'FastAPI'], 2500000, 45, 5200, false, true, 79, false],
            ['PropVerse', 'Blockchain real estate platform', 'PropTech', 'Series A', 'Fractional real estate investment platform powered by blockchain, enabling anyone to invest in premium properties from ₹10,000.', 'Real Estate Inaccessibility', 'Transaction Fee', 25, 2021, 'Mumbai, India', ['Solidity', 'React', 'Node.js', 'Ethereum', 'IPFS'], 15000000, 30, 12000, true, false, 83, true],
            ['LogiFlow', 'Last-mile delivery optimization', 'Logistics', 'Series B', 'AI-powered logistics platform reducing last-mile delivery costs by 35% through dynamic routing and predictive demand forecasting.', 'Delivery Inefficiency', 'SaaS + Commission', 80, 2019, 'Gurgaon, India', ['Python', 'ML', 'React', 'PostgreSQL', 'Kubernetes'], 35000000, 20, 450, true, false, 91, true],
        ];

        foreach ($startups as $s) {
            Startup::firstOrCreate(['name' => $s[0]], [
                'user_id' => (string)$createdUsers['startup']->_id,
                'name' => $s[0],
                'tagline' => $s[1],
                'industry' => $s[2],
                'funding_stage' => $s[3],
                'description' => $s[4],
                'problem_solving' => $s[5],
                'revenue_model' => $s[6],
                'team_size' => $s[7],
                'founded_year' => $s[8],
                'headquarters' => $s[9],
                'tech_stack' => $s[10],
                'total_raised' => $s[11],
                'monthly_growth_rate' => $s[12],
                'customer_count' => $s[13],
                'esg_focus' => $s[14],
                'women_led' => $s[15],
                'credibility_score' => $s[16],
                'is_verified' => $s[17],
                'is_active' => true,
                'is_featured' => false,
                'profile_views' => rand(500, 25000),
                'ai_profile_summary' => 'A high-potential startup with strong product-market fit, experienced team, and clear path to scale. Well-positioned for corporate partnerships.',
            ]);
        }

        // Seed Corporates
        $corporates = [
            ['TechCorp Global', 'Innovation-led technology conglomerate', 'Technology', '50,000+', 'Global technology leader investing in AI, cloud, and digital transformation startups.', ['AI/ML', 'SaaS', 'Cybersecurity', 'FinTech'], ['Automation', 'Cloud Migration', 'AI Integration'], 1000000, 10000000, 96, 42, 350],
            ['InnoBank', 'Digital-first banking for the future', 'Banking', '15,000+', 'Leading private sector bank driving fintech innovation and digital banking transformation.', ['FinTech', 'Blockchain', 'AI/ML', 'RegTech'], ['Open Banking', 'Neo Banking', 'AI Risk Assessment'], 500000, 5000000, 89, 28, 180],
            ['GreenEnergy Co', 'Accelerating India\'s clean energy transition', 'Energy', '8,000+', 'India\'s largest renewable energy company actively partnering with cleantech startups for deployment.', ['CleanTech', 'AgriTech', 'IoT'], ['Solar Microgrids', 'Battery Storage', 'Green Hydrogen'], 200000, 2000000, 84, 15, 95],
            ['HealthPlus Corp', 'Transforming healthcare through technology', 'Healthcare', '25,000+', 'Integrated healthcare company building digital health ecosystem across diagnostics, telehealth and pharma.', ['HealthTech', 'AI/ML', 'Wearables'], ['Telemedicine', 'AI Diagnostics', 'Remote Patient Monitoring'], 300000, 3000000, 87, 22, 140],
            ['ManuTech Industries', 'Smart manufacturing for Industry 4.0', 'Manufacturing', '30,000+', 'Leading manufacturer accelerating Industry 4.0 adoption through startup partnerships and open innovation.', ['DeepTech', 'IoT', 'AI/ML', 'Logistics'], ['Smart Factory', 'Predictive Maintenance', 'Supply Chain AI'], 800000, 8000000, 82, 18, 210],
            ['RetailNext', 'Reinventing the retail experience', 'Retail', '12,000+', 'Omnichannel retail giant looking for startups in personalization, supply chain and customer experience.', ['E-commerce', 'AI/ML', 'Logistics', 'FinTech'], ['Personalization', 'Last-Mile Delivery', 'BNPL'], 150000, 1500000, 78, 12, 88],
        ];

        foreach ($corporates as $c) {
            Corporate::firstOrCreate(['name' => $c[0]], [
                'user_id' => (string)$createdUsers['corporate']->_id,
                'name' => $c[0],
                'tagline' => $c[1],
                'industry' => $c[2],
                'company_size' => $c[3],
                'description' => $c[4],
                'preferred_industries' => $c[5],
                'innovation_goals' => $c[6],
                'budget_range_min' => $c[7],
                'budget_range_max' => $c[8],
                'innovation_score' => $c[9],
                'partnerships_count' => $c[10],
                'startups_scouted' => $c[11],
                'is_verified' => true,
                'is_featured' => true,
                'is_active' => true,
                'headquarters' => 'India',
            ]);
        }

        // Seed Opportunities
        $opps = [
            ['AI-Powered Customer Service Automation', 'We are looking for startups with AI/NLP capabilities to automate 80% of our customer service inquiries. The solution should integrate with our existing CRM and handle 10,000+ queries/day.', 'innovation_challenge', 'AI/ML', 2000000, 10000000, '2024-07-31', ['Pre-Seed', 'Seed', 'Series A']],
            ['Green Energy Pilot for 5 Factory Sites', 'Seeking renewable energy startups to deploy solar microgrids across 5 manufacturing facilities in Rajasthan. Combined capacity of 50MW.', 'pilot_project', 'CleanTech', 5000000, 25000000, '2024-08-15', ['Seed', 'Series A', 'Series B']],
            ['FinTech API Integration Partner', 'Looking for a neo-banking or payment infrastructure startup to build white-label embedded finance for our 2M+ enterprise customers.', 'api_integration', 'FinTech', 1000000, 5000000, '2024-07-15', ['Series A', 'Series B']],
            ['Supply Chain Optimization Vendor', 'Procurement opportunity for AI-powered supply chain software to reduce inventory costs by 20% across our 500+ supplier network.', 'vendor_requirement', 'Logistics', 3000000, 15000000, '2024-09-30', ['Seed', 'Series A', 'Series B', 'Growth']],
            ['Cybersecurity Startup Acquisition', 'Actively exploring acquisition of early-stage cybersecurity startups with proprietary zero-trust technology and ARR of ₹1-5Cr.', 'acquisition', 'Cybersecurity', 30000000, 150000000, '2024-12-31', ['Seed', 'Series A']],
            ['Healthcare AI Innovation Challenge', 'Open innovation challenge: Build an AI solution to reduce diagnostic errors in radiology by 30%. Top 3 solutions get pilot deployment.', 'innovation_challenge', 'HealthTech', 500000, 2000000, '2024-07-01', ['Pre-Seed', 'Seed']],
        ];

        $corps = Corporate::all();
        foreach ($opps as $i => $o) {
            $corp = $corps->get($i % $corps->count());
            if ($corp) {
                Opportunity::firstOrCreate(['title' => $o[0]], [
                    'corporate_id' => (string)$corp->_id,
                    'user_id' => (string)$createdUsers['corporate']->_id,
                    'title' => $o[0],
                    'description' => $o[1],
                    'type' => $o[2],
                    'industry' => $o[3],
                    'budget_min' => $o[4],
                    'budget_max' => $o[5],
                    'deadline' => $o[6],
                    'preferred_startup_stage' => $o[7],
                    'requirements' => ['Proven product with live customers', 'Team of at least 5 people', 'Ability to start pilot within 30 days'],
                    'applications_count' => rand(5, 45),
                    'views_count' => rand(100, 2000),
                    'is_featured' => $i < 3,
                    'is_active' => true,
                    'status' => 'open',
                ]);
            }
        }

        $this->command->info('✅ InnoVenture Hub seeded successfully!');
        $this->command->info('   Demo logins available at /demo-login?role=startup|corporate|investor|admin');
    }
}
