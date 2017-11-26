<?php

namespace ChemicalsBundle\Utils;

/**
 * Class VisJs Helper.
 *
 * @author Aurélien Muller
 */
class VisJsHelper
{
    /**
     * Generate VisJS code to display molecule.
     *
     * @param \stdClass $molecule
     * @param type $id
     *
     * @return string
     */
    public function generateVisJsForMolecule(\stdClass $molecule, $id = "molecule-3d")
    {
        $data = $this->generateNodesAndLinks($molecule);
        $code = "
            (function ($) {
                'use strict';
                $(document).ready(function() {
                    var nodes = new vis.DataSet(" . json_encode($data['nodes']) . ");
                    var edges = new vis.DataSet(" . json_encode($data['links']) . ");
                    var container = document.getElementById('" . $id . "');
                    var data = { nodes: nodes, edges: edges };
                    var options = {
                        nodes: {
                            shape: 'dot',
                            size: 20,
                            font: {
                                size: 22,
                                color: '#020202'
                            },
                        },
                        groups: {
                            0: {
                                shape: 'square',
                                color: 'red'
                            }
                        },
                    };
                    var network = new vis.Network(container, data, options);
                });
            })(jQuery);";

        return $code;
    }
    
    /**
     * Generates nodes and link to be processed by calling method.
     *
     * @param \stdClass $molecule
     *
     * @return string
     */
    protected function generateNodesAndLinks(\stdClass $molecule)
    {
        // We suppose everything is correctly formed.
        $data = [
            'nodes' => [],
            'links' => [],
        ];
        $data['nodes'][] = ['id' => 'molecule_' . $molecule->id, 'label' => $molecule->name, 'group' => 0];
        $i = 1;
        foreach ($molecule->atomsGroups as $atomsGroup) {
            $data['nodes'][] = ['id' => 'agroup_' . $atomsGroup->id, 'label' => $atomsGroup->name, 'group' => $i];
            $data['links'][] = ['from' => 'molecule_' . $molecule->id, 'to' => 'agroup_' . $atomsGroup->id];

            // Leading Atom.
            $data['nodes'][] = ['id' => 'mainatom_' . $atomsGroup->mainAtom->id, 'label' => $atomsGroup->mainAtom->element->formula, 'group' => $i];
            $data['links'][] = ['from' => 'agroup_' . $atomsGroup->id, 'to' => 'mainatom_' . $atomsGroup->mainAtom->id];

            // Link all the atoms to the leading one.
            foreach ($atomsGroup->atoms as $atom) {
                $data['nodes'][] = ['id' => 'atom_' . $atom->id, 'label' => $atom->element->formula, 'group' => $i];
                $data['links'][] = ['from' => 'mainatom_' . $atomsGroup->mainAtom->id, 'to' => 'atom_' . $atom->id];
            }
            $i++;
        }
        return $data;
    }
}
