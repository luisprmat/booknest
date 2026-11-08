<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Shadows of the Forgotten Realm',
                'author' => 'Eliza Thornwood',
                'image' => 'covers/1.png',
                'description' => 'A mysterious castle awakens under the moonlight as forgotten powers stir. One wanderer must confront ancient shadows, unravel hidden truths, and embrace a destiny bound to secrets older than memory itself.',
            ],
            [
                'title' => 'The Last Ember',
                'author' => 'Marcus Valen',
                'image' => 'covers/2.png',
                'description' => 'Amid a ruined world, a phoenix rises from ashes carrying humanity’s last hope. The story burns with themes of resilience, rebirth, and courage when despair seems the only choice left.',
            ],
            [
                'title' => 'Whispers of the Iron Sea',
                'author' => 'Clara Duskbane',
                'image' => 'covers/3.png',
                'description' => 'Fog-draped waters conceal more than shifting tides. Sailors speak of voices beneath the waves, and one haunted captain must decide whether to chase freedom or succumb to the sea’s eerie call.',
            ],
            [
                'title' => 'Song of the Hollow Woods',
                'author' => 'Evelyn Harrow',
                'image' => 'covers/4.png',
                'description' => 'Deep in the woods, a melody drifts through the trees. Following it leads to hidden realms where nature whispers truths and ancient guardians awaken to defend their sacred sanctuary.',
            ],
            [
                'title' => 'Beneath the Crimson Dunes',
                'author' => 'Tobias Greaves',
                'image' => 'covers/5.png',
                'description' => 'Red sands stretch endlessly, concealing ruins of forgotten empires. A lone wanderer searches for a lost artifact, uncovering treachery, legends, and secrets buried beneath centuries of shifting desert winds.',
            ],
            [
                'title' => 'The Moonlist Masquerade',
                'author' => 'Isabelle Corwin',
                'image' => 'covers/6.png',
                'description' => 'Beneath moonlit chandeliers, masked guests dance through intrigue and deception. Hidden agendas and forbidden romances entwine, where one secret unmasking could topple kingdoms and rewrite the fates of everyone attending.',
            ],
            [
                'title' => 'Fragments of Tomorrow',
                'author' => 'Caleb Winters',
                'image' => 'covers/7.png',
                'description' => 'In a fractured city of neon towers, fragments of possible futures collide. A visionary must choose between preserving order or embracing chaos to reshape tomorrow’s uncertain, fragile horizon.',
            ],
            [
                'title' => 'The Cartographer’s Curse',
                'author' => 'Lillian Storme',
                'image' => 'covers/8.png',
                'description' => 'Every map drawn by the cursed cartographer reshapes the world itself. When a daring apprentice discovers this power, she must decide whether to chart salvation or unleash devastating ruin.',
            ],
            [
                'title' => 'Ashes of the Starlit Crown',
                'author' => 'Damon Crossfield',
                'image' => 'covers/9.png',
                'description' => 'The shattered crown of an empire glimmers beneath starlight, holding promises of power and doom. Rival heirs clash, while whispers of destiny guide one reluctant hero into the heart of fire.',
            ],
            [
                'title' => 'The Keeper of Vanishing Keys',
                'author' => 'Marjorie Quinn',
                'image' => 'covers/10.png',
                'description' => 'Keys that unlock doors to forgotten worlds are vanishing. Their mysterious keeper must face betrayal and courage, protecting reality’s fragile balance before every locked secret fades forever into nothingness.',
            ],
            [
                'title' => 'Beyond the Frosted Veil',
                'author' => 'Nathanel Crowe',
                'image' => 'covers/11.png',
                'description' => 'Through shimmering frost and spectral lights lies a gateway to hidden realms. A lone traveler must brave frozen paths to uncover truths veiled by ice and time’s relentless silence.',
            ],
            [
                'title' => 'Lanterns at the Edge of Dawn',
                'author' => 'Seraphine Hale',
                'image' => 'covers/12.png',
                'description' => 'Lanterns drift across twilight skies, guiding lost souls toward hope. A young seeker follows their glow into a forgotten forest, where every light reveals secrets of past choices and redemption.',
            ],
            [
                'title' => 'The Clockmaker’s Secret',
                'author' => 'Rowan Fletcher',
                'image' => 'covers/13.png',
                'description' => 'Among towering gears and ticking brass lies a key to timeless mysteries. The clockmaker guards his secret, knowing that unlocking it could reshape destiny, or unravel the fabric of reality.',
            ],
            [
                'title' => 'When the Sky Fell Silent',
                'author' => 'Adrian Locke',
                'image' => 'covers/14.png',
                'description' => 'The world froze when the sky shattered into silence. Carrying only a lantern, a wanderer journeys through broken lands seeking answers, unaware that hope still glimmers within the quiet darkness.',
            ],
            [
                'title' => 'Echoes in Glass Tower',
                'author' => 'Selene Marrow',
                'image' => 'covers/15.png',
                'description' => 'A shimmering tower rises into the night, its walls alive with echoes of the past. One dreamer ascends, unraveling truths whispered by spirits bound within crystalline halls.',
            ],
        ];

        foreach ($books as $book) {
            Book::create([
                'title' => $book['title'],
                'author' => $book['author'],
                'image' => $book['image'],
                'description' => $book['description'],
            ]);
        }
    }
}
