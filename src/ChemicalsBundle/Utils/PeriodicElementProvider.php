<?php

namespace ChemicalsBundle\Utils;

/**
 * Class PeriodicElementProvider.
 *
 * @author Aurélien Muller
 */
class PeriodicElementProvider
{
    /**
     * Get all the periodic elements. 
     *
     * @return array
     */
    public function getPeriodicElements()
    {
        return [
            'H' => ["mass" => 1.008, "name" => "Hydrogen"],
            'He' => ["mass" => 4.002602, "name" => "Helium"],
            'Li' => ["mass" => 6.94, "name" => "Lithium"],
            'Be' => ["mass" => 9.0121831, "name" => "Beryllium"],
            'B' => ["mass" => 10.81, "name" => "Boron"],
            'C' => ["mass" => 12.011, "name" => "Carbon"],
            'N' => ["mass" => 14.007, "name" => "Nitrogen"],
            'O' => ["mass" => 15.999, "name" => "Oxygen"],
            'F' => ["mass" => 18.998403163, "name" => "Fluorine"],
            'Ne' => ["mass" => 20.1797, "name" => "Neon"],
            'Na' => ["mass" => 22.98976928, "name" => "Sodium"], 
            'Mg' => ["mass" => 24.305, "name" => "Magnesium"],
            'Al' => ["mass" => 26.9815385, "name" => "Aluminum"],
            'Si' => ["mass" => 28.085, "name" => "Silicon"],
            'P' => ["mass" => 30.973761998, "name" => "Phosphorus"],
            'S' => ["mass" => 32.06, "name" => "Sulfur"],
            'Cl' => ["mass" => 35.45, "name" => "Chlorine"],
            'Ar' => ["mass" => 39.948, "name" => "Argon"],
            'K' => ["mass" => 39.0983, "name" => "Potassium"],
            'Ca' => ["mass" => 40.078, "name" => "Calcium"],
            'Sc' => ["mass" => 44.955908, "name" => "Scandium"],
            'Ti' => ["mass" => 47.867, "name" => "Titanium"],
            'V' => ["mass" => 50.9415, "name" => "Vanadium"],
            'Cr' => ["mass" => 51.9961, "name" => "Chromium"],
            'Mn' => ["mass" => 54.938044, "name" => "Manganese"],
            'Fe' => ["mass" => 55.845, "name" => "Iron"],
            'Co' => ["mass" => 58.933194, "name" => "Cobalt"],
            'Ni' => ["mass" => 58.6934, "name" => "Nickel"],
            'Cu' => ["mass" => 63.546, "name" => "Copper"],
            'Zn' => ["mass" => 65.38, "name" => "Zinc"],
            'Ga' => ["mass" => 69.723, "name" => "Gallium"],
            'Ge' => ["mass" => 72.63, "name" => "Germanium"],
            'As' => ["mass" => 74.921595, "name" => "Arsenic"],
            'Se' => ["mass" => 78.971, "name" => "Selenium"],
            'Br' => ["mass" => 79.904, "name" => "Bromine"],
            'Kr' => ["mass" => 83.798, "name" => "Krypton"],
            'Rb' => ["mass" => 85.4678, "name" => "Rubidium"],
            'Sr' => ["mass" => 87.92, "name" => "Strontium"],
            'Y' => ["mass" => 88.90584, "name" => "Yttrium"],
            'Zr' => ["mass" => 91.224, "name" => "Zirconium"],
            'Nb' => ["mass" => 92.90637, "name" => "Niobium"],
            'Mo' => ["mass" => 95.95, "name" => "Molybdenum"],
            'Tc' => ["mass" => 98, "name" => "Technetium"],
            'Ru' => ["mass" => 101.07, "name" => "Ruthnetium"],
            'Rh' => ["mass" => 102.90550, "name" => "Rhodium"], 
            'Pd' => ["mass" => 106.42, "name" => "Palladium"],
            'Ag' => ["mass" => 107.8682, "name" => "Silver"],
            'Cd' => ["mass" => 112.414, "name" => "Cadmium"],
            'In' => ["mass" => 114.818, "name" => "Indium"],
            'Sn' => ["mass" => 118.710, "name" => "Tin"],
            'Sb' => ["mass" => 121.760, "name" => "Antimony"],
            'Te' => ["mass" => 127.60, "name" => "Tellurium"],
            'I' => ["mass" => 126.90447, "name" => "Iodine"],
            'Xe' => ["mass" => 131.293, "name" => "Xenon"],
            'Cs' => ["mass" => 132.90545196, "name" => "Cesium"],
            'Ba' => ["mass" => 137.327, "name" => "Barium"],
            'La' => ["mass" => 138.90547, "name" => "Lanthanum"],
            'Ce' => ["mass" => 140.116, "name" => "Cerium"],
            'Pr' => ["mass" => 140.90766, "name" => "Praseodymium"],
            'Nd' => ["mass" => 144.242, "name" => "Neodymium"],
            'Pm' => ["mass" => 145, "name" => "Promethium"],
            'Sm' => ["mass" => 150.36, "name" => "Samarium"],
            'Eu' => ["mass" => 151.964, "name" => "Europium"],
            'Gd' => ["mass" => 157.25, "name" => "Gadolinium"],
            'Tb' => ["mass" => 158.92535, "name" => "Terbium"],
            'Dy' => ["mass" => 162.500, "name" => "Dysprosium"],
            'Ho' => ["mass" => 164.93033, "name" => "Holmium"],
            'Er' => ["mass" => 167.259, "name" => "Erbium"],
            'Tm' => ["mass" => 168.93422, "name" => "Thulium"],
            'Yb' => ["mass" => 173.054, "name" => "Ytterbium"],
            'Lu' => ["mass" => 174.9668, "name" => "Lutetium"],
            'Hf' => ["mass" => 178.49, "name" => "Hafnium"],
            'Ta' => ["mass" => 180.94788, "name" => "Tantalum"],
            'W' => ["mass" => 183.84, "name" => "Tungsten"],
            'Re' => ["mass" => 186.207, "name" => "Rhenium"],
            'Os' => ["mass" => 190.23, "name" => "Osmium"],
            'Ir' => ["mass" => 192.217, "name" => "Iridium"],
            'Pt' => ["mass" => 195.084, "name" => "Platinum"],
            'Au' => ["mass" => 196.966569, "name" => "Gold"],
            'Hg' => ["mass" => 200.59, "name" => "Mercury"],
            'Tl' => ["mass" => 204.38, "name" => "Thallium"],
            'Pb' => ["mass" => 207.2, "name" => "Lead"],
            'Bi' => ["mass" => 208.98040, "name" => "Bismuth"],
            'Po' => ["mass" => 209, "name" => "Polonium"],
            'At' => ["mass" => 210, "name" => "Astatine"],
            'Rn' => ["mass" => 222, "name" => "Radon"],
            'Fr' => ["mass" => 223, "name" => "Francium"],
            'Ra' => ["mass" => 226, "name" => "Radium"],
            'Ac' => ["mass" => 227, "name" => "Actinium"],
            'Th' => ["mass" => 232.0377, "name" => "Thorium"],
            'Pa' => ["mass" => 231.03588, "name" => "Protactinium"],
            'U' => ["mass" => 238.02891, "name" => "Uranium"],
            'Np' => ["mass" => 237, "name" => "Neptunium"],
            'Pu' => ["mass" => 244, "name" => "Plutonium"],
            'Am' => ["mass" => 243, "name" => "Americium"],
            'Cm' => ["mass" => 247, "name" => "Curium"],
            'Bk' => ["mass" => 247, "name" => "Berkelium"],
            'Cf' => ["mass" => 251, "name" => "Californium"],
            'Es' => ["mass" => 252, "name" => "Einsteinium"],
            'Fm' => ["mass" => 257, "name" => "Fermium"],
            'Md' => ["mass" => 258, "name" => "Mendelevium"],
            'No' => ["mass" => 259, "name" => "Nobelium"],
            'Lr' => ["mass" => 262, "name" => "Lawrencium"],
            'Rf' => ["mass" => 267, "name" => "Rutherfordium"],
            'Db' => ["mass" => 268, "name" => "Dubnium"],
            'Sg' => ["mass" => 271, "name" => "Seaborgium"],
            'Bh' => ["mass" => 272, "name" => "Bohrium"],
            'Hs' => ["mass" => 270, "name" => "Hassium"],
            'Mt' => ["mass" => 276, "name" => "Meitnerium"],
            'Ds' => ["mass" => 281, "name" => "Darmstadtium"],
            'Rg' => ["mass" => 280, "name" => "Roentgenium"],
            'Cn' => ["mass" => 285, "name" => "Copernicium"],
            'Nh' => ["mass" => 284, "name" => "Nihonium"],
            'Fl' => ["mass" => 289, "name" => "Flevorium"],
            'Mc' => ["mass" => 288, "name" => "Moscovium"],
            'Lv' => ["mass" => 293, "name" => "Livermorium"],
            'Ts' => ["mass" => 294, "name" => "Tennessine"],
            'Og' => ["mass" => 294, "name" => "Oganesson"]
        ];
    }
}