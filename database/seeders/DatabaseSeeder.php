<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ItemRequest;
use App\Models\ItemRequestDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users
        $admin = User::create([
            'name' => 'Vogue Atelier Admin',
            'email' => 'admin@company.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+1 (800) 789-VELVET',
            'company_name' => 'Vogue & Velvet HQ',
            'address' => '5th Avenue Fashion District, Suite 1200, New York, NY',
        ]);

        $customer = User::create([
            'name' => 'Sophia Laurent',
            'email' => 'customer@company.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '+1 (555) 432-8765',
            'company_name' => 'Laurent Design House',
            'address' => '842 Beverly Blvd, Los Angeles, CA',
        ]);

        // 2. Create Ladies Dress Categories
        $categories = [
            [
                'name' => 'Evening & Gala Gowns',
                'slug' => 'evening-gala-gowns',
                'description' => 'Floor-length red carpet gowns, sequin evening dresses, and velvet haute couture.',
                'icon' => 'sparkles',
                'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'name' => 'Cocktail & Party Dresses',
                'slug' => 'cocktail-party-dresses',
                'description' => 'Chic mini dresses, bodycon satin party dresses, and elegant cocktail silhouettes.',
                'icon' => 'glass-cheers',
                'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'name' => 'Casual & Summer Midi Dresses',
                'slug' => 'casual-summer-dresses',
                'description' => 'Breezy linen sundresses, romantic floral wrap midis, and effortless resort wear.',
                'icon' => 'sun',
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'name' => 'Tailored Chic & Workwear',
                'slug' => 'tailored-chic-dresses',
                'description' => 'Sophisticated blazer dresses, structured pencil midis, and elegant executive silhouettes.',
                'icon' => 'briefcase',
                'image' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=800&auto=format&fit=crop',
                'is_featured' => false,
            ],
        ];

        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[$cat['slug']] = Category::create($cat);
        }

        // 3. Create Ladies Dresses
        $products = [
            [
                'category_slug' => 'evening-gala-gowns',
                'name' => 'Elysian Gold Sequin Floor-Length Gala Gown',
                'slug' => 'elysian-gold-sequin-gala-gown',
                'sku' => 'DRS-EGL-901',
                'price' => 450.00,
                'description' => 'Dazzling floor-length evening gown embellished with hand-stitched gold sequins, a flattering plunge V-neckline, and an elegant side thigh slit.',
                'specifications' => [
                    'Fabric' => 'Luxury Sequin Mesh & Heavy Silk Lining',
                    'Available Sizes' => 'XS, S, M, L, XL',
                    'Fit Type' => 'Slim Fit Floor Length',
                    'Care Instructions' => 'Dry Clean Only',
                    'Closure' => 'Concealed Back Zipper'
                ],
                'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 15,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'evening-gala-gowns',
                'name' => 'Velvet Royale Midnight Blue Evening Gown',
                'slug' => 'velvet-royale-midnight-blue-gown',
                'sku' => 'DRS-VRM-902',
                'price' => 380.00,
                'description' => 'Sumptuous midnight blue plush velvet gown featuring off-the-shoulder draping, structured inner boning corset, and a graceful fishtail train.',
                'specifications' => [
                    'Fabric' => '95% Premium Velvet, 5% Elastane',
                    'Available Sizes' => 'XS, S, M, L',
                    'Fit Type' => 'Mermaid Silhouette',
                    'Care Instructions' => 'Specialist Dry Clean',
                    'Closure' => 'Hidden Back Zip with Hook'
                ],
                'image' => 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 12,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'cocktail-party-dresses',
                'name' => 'Silk Satin Backless Cowl Neck Slip Dress',
                'slug' => 'silk-satin-backless-cowl-slip-dress',
                'sku' => 'DRS-SSB-801',
                'price' => 260.00,
                'description' => 'Sensual champagne silk satin bias-cut midi dress styled with a delicate cowl neckline, adjustable spaghetti straps, and a deep open back.',
                'specifications' => [
                    'Fabric' => '100% Pure Mulberry Silk Satin',
                    'Available Sizes' => 'XS, S, M, L',
                    'Fit Type' => 'Bias Cut Body-Skimming',
                    'Care Instructions' => 'Hand Wash Cold or Dry Clean',
                    'Length' => 'Midi (Below Knee)'
                ],
                'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 25,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'cocktail-party-dresses',
                'name' => 'Blush Rose Corset Satin Mini Dress',
                'slug' => 'blush-rose-corset-satin-mini-dress',
                'sku' => 'DRS-BRC-802',
                'price' => 210.00,
                'description' => 'Ultra-chic blush pink corset mini dress featuring a structured boned bodice, sweetheart cup bust line, and draped satin tulip skirt.',
                'specifications' => [
                    'Fabric' => 'Heavyweight Stretch Satin',
                    'Available Sizes' => 'XS, S, M, L',
                    'Fit Type' => 'Corseted Bodycon',
                    'Care Instructions' => 'Dry Clean Only',
                    'Length' => 'Mini'
                ],
                'image' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 20,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'casual-summer-dresses',
                'name' => 'Solstice Pure Linen Wrap Summer Midi Dress',
                'slug' => 'solstice-pure-linen-wrap-midi-dress',
                'sku' => 'DRS-SLW-701',
                'price' => 180.00,
                'description' => 'Breezy olive green 100% European linen wrap dress styled with short puff sleeves, an adjustable waist tie ribbon, and breathable linen weave.',
                'specifications' => [
                    'Fabric' => '100% Organic European Linen',
                    'Available Sizes' => 'S, M, L, XL',
                    'Fit Type' => 'Relaxed Wrap Fit',
                    'Care Instructions' => 'Machine Wash Gentle Cold',
                    'Features' => 'Side Pockets included'
                ],
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 30,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'casual-summer-dresses',
                'name' => 'Celeste French Floral Tiered Ruffle Sundress',
                'slug' => 'celeste-french-floral-tiered-sundress',
                'sku' => 'DRS-CFT-702',
                'price' => 195.00,
                'description' => 'Charming French-inspired floral print chiffon dress featuring a tiered ruffle skirt, smocked stretch waistband, and feminine tie shoulder straps.',
                'specifications' => [
                    'Fabric' => '100% Lightweight Silk Chiffon',
                    'Available Sizes' => 'XS, S, M, L',
                    'Fit Type' => 'A-Line Flowy',
                    'Care Instructions' => 'Hand Wash Cold',
                    'Lining' => 'Fully Lined Soft Rayon'
                ],
                'image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 18,
                'is_featured' => false,
            ],
            [
                'category_slug' => 'tailored-chic-dresses',
                'name' => 'Monaco Double-Breasted Tailored Blazer Dress',
                'slug' => 'monaco-double-breasted-tailored-blazer-dress',
                'sku' => 'DRS-MDB-601',
                'price' => 310.00,
                'description' => 'Power dressing meets haute couture. Ivory double-breasted tuxedo blazer dress accented with gold crest buttons and sharp padded shoulders.',
                'specifications' => [
                    'Fabric' => 'Structured Crepe Blend',
                    'Available Sizes' => 'XS, S, M, L, XL',
                    'Fit Type' => 'Structured Tailored Fit',
                    'Care Instructions' => 'Dry Clean Only',
                    'Details' => 'Gold Embossed Crest Buttons'
                ],
                'image' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 14,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'tailored-chic-dresses',
                'name' => 'Ophelia Emerald Velvet Belted Wrap Midi Dress',
                'slug' => 'ophelia-emerald-velvet-belted-midi-dress',
                'sku' => 'DRS-OEV-602',
                'price' => 275.00,
                'description' => 'Rich emerald green velvet wrap dress designed with long bishop sleeves, a satin-trimmed lapel collar, and matching fabric waist belt.',
                'specifications' => [
                    'Fabric' => 'Stretch Luxe Velvet',
                    'Available Sizes' => 'S, M, L, XL',
                    'Fit Type' => 'Tailored Wrap',
                    'Care Instructions' => 'Dry Clean Only',
                    'Sleeves' => 'Long Bishop Sleeves with Button Cuffs'
                ],
                'image' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 16,
                'is_featured' => false,
            ],
            [
                'category_slug' => 'cocktail-party-dresses',
                'name' => 'Siren Classic Little Black Satin Party Dress',
                'slug' => 'siren-classic-little-black-satin-dress',
                'sku' => 'DRS-SLB-803',
                'price' => 220.00,
                'description' => 'The essential LBD. Sleek black stretch satin fitted dress featuring an off-the-shoulder neckline, side ruching, and a concealed back slit.',
                'specifications' => [
                    'Fabric' => 'Heavy Stretch Satin',
                    'Available Sizes' => 'XS, S, M, L',
                    'Fit Type' => 'Bodycon Ruched',
                    'Care Instructions' => 'Dry Clean',
                    'Color' => 'Jet Black'
                ],
                'image' => 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=800&auto=format&fit=crop',
                'availability_status' => 'In Stock',
                'stock_quantity' => 22,
                'is_featured' => false,
            ],
            [
                'category_slug' => 'evening-gala-gowns',
                'name' => 'Aura Floral Embroidered Tulle Ballgown',
                'slug' => 'aura-floral-embroidered-tulle-ballgown',
                'sku' => 'DRS-AFE-903',
                'price' => 490.00,
                'description' => 'Enchanting fairytale ballgown crafted with layers of sheer blush tulle, intricate 3D floral embroidery, and a corseted boned sweetheart bodice.',
                'specifications' => [
                    'Fabric' => '3D Floral Embroidered Fine Tulle',
                    'Available Sizes' => 'XS, S, M, L',
                    'Fit Type' => 'Ballgown Silhouette',
                    'Care Instructions' => 'Haute Couture Dry Clean Only',
                    'Closure' => 'Lace-Up Corset Back'
                ],
                'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?w=800&auto=format&fit=crop',
                'availability_status' => 'Available on Request',
                'stock_quantity' => 6,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $pData) {
            $catSlug = $pData['category_slug'];
            unset($pData['category_slug']);
            $pData['category_id'] = $createdCategories[$catSlug]->id;
            Product::create($pData);
        }

        // 4. Create Sample Dress Requests for Admin preview
        $req1 = ItemRequest::create([
            'reference_code' => 'REQ-' . date('Ymd') . '-D8A1',
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'customer_phone' => $customer->phone,
            'company_name' => 'Laurent Fashion Boutique',
            'delivery_address' => $customer->address,
            'notes' => 'Boutique inquiry: Requesting size S & M reservations for upcoming gala event styling.',
            'total_estimated_value' => 830.00,
            'status' => 'new',
            'admin_notes' => null,
            'email_sent_at' => now(),
        ]);

        ItemRequestDetail::create([
            'item_request_id' => $req1->id,
            'product_id' => Product::where('sku', 'DRS-EGL-901')->first()->id,
            'product_name' => 'Elysian Gold Sequin Floor-Length Gala Gown (Size: M)',
            'product_sku' => 'DRS-EGL-901',
            'unit_price' => 450.00,
            'quantity' => 1,
            'subtotal' => 450.00,
        ]);

        ItemRequestDetail::create([
            'item_request_id' => $req1->id,
            'product_id' => Product::where('sku', 'DRS-VRM-902')->first()->id,
            'product_name' => 'Velvet Royale Midnight Blue Evening Gown (Size: S)',
            'product_sku' => 'DRS-VRM-902',
            'unit_price' => 380.00,
            'quantity' => 1,
            'subtotal' => 380.00,
        ]);
    }
}
