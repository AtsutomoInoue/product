<?php
declare(strict_types=1);
namespace Tests\Unit;

use Tests\TestCase;

abstract class TasksRepositoryInterfaceTest extends TestCase
{

    /**
     * @test
     * @group DataAccess
     * @group Tasks
     * @group all
     */
    public function all_rerutn_array()
    {
        $this->assertTrue(is_array($this->Tasks->all()));
    }
    /**
     * @test
     * @group DataAccess
     * @group Tasks
     * @group all
     */
    public function all_field()
    {
        $data = $this->Tasks->all();

        $expected = [
            'id', 'title', 'body',  'limit', 'process_id', 'created_at', 'updated_at'
          ];

        $this->assertSame($expected, array_keys($data[0]));
    }

    /**
     * @test
     * @group DataAccess
     * @group Tasks
     * @group get
     */
    public function get_return_array_get_to_1()
    {
      $this->assertTrue(is_array($this->Tasks->get(1)));
    }

    /**
    * @test
    * @group DataAccess
    * @group Tasks
    * @group get
    */
    public function get_fields()
    {
      $data = $this->Tasks->get(1);

      $expected = [
          'id', 'title', 'body',  'limit', 'process_id', 'created_at', 'updated_at'
        ];

    $this->assertSame($expected, array_keys($data));
    }
    /**
      * @test
      * @group DataAccess
      * @group Tasks
      * @group insert
      */
     public function insert_success()
     {
         $title = 'member_011';
         $body = 'all unit';
         $limit = 20200101;
         $process_id = 1;


         $this->Tasks->insert($title,$body,$limit,$process_id);

         $this->assertDatabaseHas('tasks', [
             'title' => $title,
             'body' => $body,
             'limit' => $limit,
             'process_id' => $process_id
         ]);
     }

     /**
      * @test
      * @doesNotPerformAssertions
      * @group DataAccess
      * @group Tasks
      * @group insert
      */
     public function insert_blank()
     {
         $this->Tasks->insert('','',19700101,0,);
     }

     /**
      * @test
      * @param App\Repositories\date $limit
      * @group DataAccess
      * @group Tasks
      * @group update
      */

     public function update_success()
     {
      // $date = '2020-12-31';
       //$datef = new Date();

         $id = 1;
         $title = 'ほげほげ';
         $body = '今は昔、竹取の翁といふものありけり。野山にまじりて竹を取りつつ、よろづのことに使ひけり。';
         $limit = 20201231;
         $process_id = 1;

         $this->Tasks->update($id, $title, $body, $limit, $process_id);

         $this->assertDatabaseHas('tasks', [
             'id' => $id,
             'title' => $title,
             'body' => $body,
             'limit' => $limit,
             'process_id' => $process_id
         ]);
     }

     /**
      * @test
      * @doesNotPerformAssertions
      * @group DataAccess
      * @group Tasks
      * @group update
      */
     public function update_blank()
     {
         $id = 1;
         $this->Tasks->update(1, '','',19700101,0);
     }

     /**
      * @test
      * @group DataAccess
      * @group Tasks
      * @group delete
      */
     public function delete_success()
     {
         $id = 1;

         $this->Tasks->delete($id);

         $this->assertDatabaseMissing('tasks', [
             'id' => $id
         ]);
     }
}
