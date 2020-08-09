<?php
declare(strict_types=1);
namespace Tests\Unit;

use Tests\TestCase;

abstract class PlamodelsRepositoryInterfaceTest extends TestCase
{

    /**
     * @test
     * @group DataAccess
     * @group Plamodels
     * @group all
     */
    public function all_返り値は配列であること()
    {
        $this->assertTrue(is_array($this->Plamodels->all()));
    }
    /**
     * @test
     * @group DataAccess
     * @group Plamodels
     * @group all
     */
    public function all_必要なフィールドが取得されている事()
    {
        $data = $this->Plamodels->all();

        $expected = [
            'id', 'name', 'maker', 'price', 'released', 'point', 'comment', 'created_at', 'updated_at'
        ];

        $this->assertSame($expected, array_keys($data[0]));
    }

    /**
     * @test
     * @group DataAccess
     * @group Plamodels
     * @group get
     */
    public function get_返り値は配列であること()
    {
        $this->assertTrue(is_array($this->Plamodels->get(1)));
    }

    /**
     * @test
     * @group DataAccess
     * @group Plamodels
     * @group get
     */
    public function get_必要なフィールドが取得されている事()
    {
        $data = $this->Plamodels->get(1);

        $expected = [
            'id', 'name', 'maker', 'price', 'released', 'point', 'comment', 'created_at', 'updated_at'
        ];

        $this->assertSame($expected, array_keys($data));
    }

    /**
     * @test
     * @group DataAccess
     * @group Plamodels
     * @group insert
     */
    public function insert_登録処理が成功する事を検証()
    {
        $name = 'aaaa1';
        $maker = 'hogehoge';
        $price = 100;
        $released = 199004;
        $point = '初心者でも簡単';
        $comment = '接着剤いらずで簡単に組み立てられる';

        $this->Plamodels->insert($name,$maker,$price,$released,$point,$comment);

        $this->assertDatabaseHas('plamodels', [
            'name' => $name,
            'maker' => $maker,
            'price' => $price,
            'released' => $released,
            'point' => $point,
            'comment' => $comment
        ]);
    }

    /**
     * @test
     * @doesNotPerformAssertions
     * @group DataAccess
     * @group Plamodels
     * @group insert
     */
    public function insert_空文字が渡ってきた場合()
    {
        $this->Plamodels->insert('', '', 0, 0, '', '');
    }

    /**
     * @test
     * @group DataAccess
     * @group Plamodels
     * @group update
     */
    public function update_更新処理が成功する事を検証()
    {
        $id = 1;
        $name = 'tank';
        $maker = 'abcdfactory';
        $price = 1400;
        $released = 199004;
        $point = 'allmighty';
        $comment = '初心者なら組み立てるだけで精密な出来上がりになり、上級者なら塗装でより
        クオリティの高い出来栄えになる。';

        $this->Plamodels->update($id, $name, $maker, $price, $released, $point, $comment);

        $this->assertDatabaseHas('plamodels', [
            'id' => $id,
            'name' => $name,
            'maker' => $maker,
            'price' => $price,
            'released' => $released,
            'point' => $point,
            'comment' => $comment
        ]);
    }

    /**
     * @test
     * @doesNotPerformAssertions
     * @group DataAccess
     * @group Plamodels
     * @group update
     */
    public function update_空文字が渡ってきた場合()
    {
        //$this->expectException();
        $id = 1;
        $this->Plamodels->update(1, '', '', 0, 0, '', '');
    }

    /**
     * @test
     * @group DataAccess
     * @group Plamodels
     * @group delete
     */
    public function delete_削除処理が成功する事を検証()
    {
        $id = 1;

        $this->Plamodels->delete($id);

        $this->assertDatabaseMissing('plamodels', [
            'id' => $id
        ]);
    }
}
