<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'    => 'hydrogen11',
            'email'       => 'karouinour@gmail.com',
            'first_name'  => 'Nour',
            'last_name'   => 'Karoui',
            'address'     => '1-24-28 Taito-ku kitaueno',
            'city'        => 'tokyo',
            'city'        => '1100014',
            'password'    => Hash::make('nounou'),
            'verified'    => 1,
            'admin'       => 1,
        ]);

        DB::table('categories')->insert([
            'category'    => 'category 1',
            'description' => 'category lorem  ipsum hello word category1'
        ]);
        DB::table('categories')->insert([
            'category'    => 'category 2',
            'description' => 'category lorem  ipsum hello word category2'
        ]);
        DB::table('categories')->insert([
            'category'    => 'category 3',
            'description' => 'category lorem  ipsum hello word category3'
        ]);
        DB::table('categories')->insert([
            'category'    => 'category 4',
            'description' => 'category lorem  ipsum hello word category4'
        ]);
        DB::table('categories')->insert([
            'category'    => 'category 5',
            'description' => 'category lorem  ipsum hello word category5'
        ]);

        DB::table('products')->insert([
            'product_name' => 'product 1',
            'price'        =>  120.00,
            'reduced_price'=> 0,
            'category_id'  => 1,
            'product_qty'  => 120,
            'description'  =>'products lorem  ipsum hello word products1',
            'created_at'   => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => 'product 2',
            'price'        =>  200.00,
            'reduced_price'=> 0,
            'category_id'  => 2,
            'product_qty'  => 120,
            'description'  =>'products lorem  ipsum hello word products2',
            //'created_at'   => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => 'product 3',
            'price'        =>  20.00,
            'reduced_price'=> 0,
            'category_id'  => 1,
            'product_qty'  => 120,
            'description'  =>'products lorem  ipsum hello word products3',
            //'created_at'   => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => 'product 4',
            'price'        =>  500.00,
            'reduced_price'=> 0,
            'category_id'  => 1,
            'product_qty'  => 10,
            'description'  =>'products lorem  ipsum hello word products4',
            //'created_at'   => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => 'product 5',
            'price'        =>  300.00,
            'reduced_price'=> 0,
            'category_id'  => 4,
            'product_qty'  => 40,
            'description'  =>'products lorem  ipsum hello word products5',
            //'created_at'   => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('product_images')->insert([
            'product_id'    => 1,
            'name'          => '688aa553ddb237dabc282454f943badeebd93bdd.jpg',
            'path'          => 'src/public/ProductPhotos/photos/688aa553ddb237dabc282454f943badeebd93bdd.jpg',
            'thumbnail_path'=> 'src/public/ProductPhotos/photos/th-688aa553ddb237dabc282454f943badeebd93bdd.jpg',
            'featured'      => 1,
        ]);
        DB::table('product_images')->insert([
            'product_id'    => 2,
            'name'          => 'abf429410880b26d2c3ea566719b9bd07fe486a8.jpg',
            'path'          => 'src/public/ProductPhotos/photos/abf429410880b26d2c3ea566719b9bd07fe486a8.jpg',
            'thumbnail_path'=> 'src/public/ProductPhotos/photos/th-abf429410880b26d2c3ea566719b9bd07fe486a8.jpg',
            'featured'      => 1,
        ]);
        DB::table('product_images')->insert([
            'product_id'    => 3,
            'name'          => 'b568d022a595c782189d98de8844a5d2e2c7cd9f.jpg',
            'path'          => 'src/public/ProductPhotos/photos/b568d022a595c782189d98de8844a5d2e2c7cd9f.jpg',
            'thumbnail_path'=> 'src/public/ProductPhotos/photos/th-b568d022a595c782189d98de8844a5d2e2c7cd9f.jpg',
            'featured'      => 1,
        ]);
        DB::table('product_images')->insert([
            'product_id'    => 4,
            'name'          => '0f89dcd79a49d1e29211f6ff70de7503b6823c6f.jpg',
            'path'          => 'src/public/ProductPhotos/photos/0f89dcd79a49d1e29211f6ff70de7503b6823c6f.jpg',
            'thumbnail_path'=> 'src/public/ProductPhotos/photos/th-0f89dcd79a49d1e29211f6ff70de7503b6823c6f.jpg',
            'featured'      => 1,
        ]);

    }
}
