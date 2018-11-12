<?php

/**
 * Akkar Global Services - Colors Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Agosto 01 - 2016)
 */

use App\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $colors = array(
            array("description" => "RED", "hexadecimal" => "#E12737", "secondary_hex" => null),
            array("description" => "BLACK", "hexadecimal" => "#000000", "secondary_hex" => null),
            array("description" => "WHITE", "hexadecimal" => "#FFFFFF", "secondary_hex" => null),
            array("description" => "BROWN", "hexadecimal" => "#A52A2A", "secondary_hex" => null),
            array("description" => "BLUE", "hexadecimal" => "#0000FF", "secondary_hex" => null),
            array("description" => "LIGHT BLUE", "hexadecimal" => "#ADD8E6", "secondary_hex" => null),
            array("description" => "DARK BLUE", "hexadecimal" => "#00008B ", "secondary_hex" => null),
            array("description" => "GUN METAL", "hexadecimal" => "#2B3B44 ", "secondary_hex" => null),
            array("description" => "CYAN", "hexadecimal" => "#3FA9F6", "secondary_hex" => null),
            array("description" => "PINK", "hexadecimal" => "#F46BBD", "secondary_hex" => null),
            array("description" => "PINK METAL", "hexadecimal" => "#ff69b4", "secondary_hex" => null),
            array("description" => "PURPLE", "hexadecimal" => "#B745C1", "secondary_hex" => null),
            array("description" => "GRAPE", "hexadecimal" => "#421C52", "secondary_hex" => null),
            array("description" => "GREEN", "hexadecimal" => "#78A941", "secondary_hex" => null),
            array("description" => "GRAY", "hexadecimal" => "#2A3642", "secondary_hex" => null),
            array("description" => "METAL GRAY", "hexadecimal" => "#7b9095", "secondary_hex" => null),
            array("description" => "SILVER", "hexadecimal" => "#C0C0C0", "secondary_hex" => null),
            array("description" => "FUCHSIA", "hexadecimal" => "#FF005A", "secondary_hex" => null),
            array("description" => "GOLD", "hexadecimal" => "#D4AF37", "secondary_hex" => null),
            array("description" => "YELLOW", "hexadecimal" => "#ffff00", "secondary_hex" => null),
            array("description" => "ORANGE", "hexadecimal" => "#CD6D37", "secondary_hex" => null),

            array("description" => "BLACK-BLACK", "hexadecimal" => "#000000", "secondary_hex" => "#000000"),
            array("description" => "BLACK-GRAY", "hexadecimal" => "#000000", "secondary_hex" => "#2A3642"),
            array("description" => "BLACK-RED", "hexadecimal" => "#000000", "secondary_hex" => "#E12737"),
            array("description" => "BLACK-GREEN", "hexadecimal" => "#000000", "secondary_hex" => "#78A941"),
            array("description" => "BLACK-YELLOW", "hexadecimal" => "#000000", "secondary_hex" => "#ffff00"),
            array("description" => "BLACK-ORANGE", "hexadecimal" => "#000000", "secondary_hex" => "#CD6D37"),
            array("description" => "BLACK-BLUE", "hexadecimal" => "#000000", "secondary_hex" => "#0000FF"),
            array("description" => "BLACK-WHITE", "hexadecimal" => "#000000", "secondary_hex" => "#FFFFFF"),
            array("description" => "BLACK-GUN METAL", "hexadecimal" => "#000000", "secondary_hex" => "#2B3B44"),
            array("description" => "BLACK-SILVER", "hexadecimal" => "#000000", "secondary_hex" => "#C0C0C0"),
            array("description" => "BLACK-GRAPE", "hexadecimal" => "#000000", "secondary_hex" => "#421C52"),

            array("description" => "WHITE-PINK", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#F46BBD"),
            array("description" => "WHITE-WHITE", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#FFFFFF"),
            array("description" => "WHITE-LIGHT BLUE", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#ADD8E6"),
            array("description" => "WHITE-LIGHT GRAY", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#C1C1C1"),
            array("description" => "WHITE-BLUE", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#0000FF"),
            array("description" => "WHITE-DARK BLUE", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#00008B "),
            array("description" => "WHITE-BROWN", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#A52A2A"),
            array("description" => "WHITE-GOLD", "hexadecimal" => "#FFFFFF", "secondary_hex" => "#D4AF37"),
        );

        foreach ($colors as $color) {
            Color::create([
                'description' => $color['description'],
                'hexadecimal'  => $color['hexadecimal'],
                'secondary_hex'  => $color['secondary_hex'],
            ]);
        }
    }
}
