<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;

abstract class CyclingsRepositoryInterfaceTest extends TestCase
{
  /**
      * @test
      * @group DataAccess
      * @group Members
      * @group all
      */
     public function all_返り値は配列であること()
     {
         $this->assertTrue(is_array($this->Cyclings->all()));
     }

     /**
      * @test
      * @group DataAccess
      * @group Members
      * @group all
      */
     public function all_必要なフィールドが取得されている事()
     {
         $data = $this->Cyclings->all();

         $expected = [
             'id', 'place', 'address', 'comment', 'created_at', 'updated_at'
         ];

         $this->assertSame($expected, array_keys($data[0]));
     }

     /**
      * @test
      * @group DataAccess
      * @group Members
      * @group get
      */
     public function get_返り値は配列であること()
     {
         $this->assertTrue(is_array($this->Cyclings->get(1)));
     }

     /**
      * @test
      * @group DataAccess
      * @group Members
      * @group get
      */
     public function get_必要なフィールドが取得されている事()
     {
         $data = $this->Cyclings->get(1);

         $expected = [
             'id', 'place', 'address', 'comment', 'created_at', 'updated_at'
         ];

         $this->assertSame($expected, array_keys($data));
     }

     /**
      * @test
      * @group DataAccess
      * @group Members
      * @group insert
      */
     public function insert_登録処理が成功する事を検証()
     {
         $place = 'かかか商店街';
         $address = '〇〇県××市□□１－２－３';
         $comment = '地元に愛されている商店街です';

         $this->Cyclings->insert($place, $address, $comment);

         $this->assertDatabaseHas('cyclings', [
             'place' => $place,
             'address' => $address,
             'comment' => $comment
         ]);
     }

     /**
      * @test
     * @doesNotPerformAssertions
      * @group DataAccess
      * @group Members
      * @group insert
      */
     public function insert_空文字が渡ってきた場合()
     {
         $this->Cyclings->insert('','','');
     }

     /**
      * @test
      * @group DataAccess
      * @group Members
      * @group update
      */
     public function update_更新処理が成功する事を検証()
     {
         $id = 1;
         $place = '料亭わをん';
         $address = '●県▽市☆４－５－６';
         $comment = '500円のお昼定食がおすすめです';

         $this->Cyclings->update($id, $place, $address, $comment);

         $this->assertDatabaseHas('cyclings', [
           'place' => $place,
           'address' => $address,
           'comment' => $comment
         ]);
     }

     /**
      * @test
      * @doesNotPerformAssertions
      * @group DataAccess
      * @group Members
      * @group update
      */
     public function update_空文字が渡ってきた場合()
     {
         $this->Cyclings->update(1, '','','');
     }

     /**
      * @test
      * @group DataAccess
      * @group Members
      * @group delete
      */
     public function delete_削除処理が成功する事を検証()
     {
         $id = 1;

         $this->Cyclings->delete($id);

         $this->assertDatabaseMissing('cyclings', [
             'id' => $id
         ]);
     }
}
