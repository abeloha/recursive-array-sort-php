<?php
function prioritize_nodes(array $tree, $target_val): array {
    if (!$tree || !array_key_exists("children", $tree)) {
        return $tree;
    }

    reresult_node_nodes_recursive($tree["children"], $target_val);
    return $tree;
}

function reresult_node_nodes_recursive(&$children, $target_val) {
    $result_node = [];
    $sort_is_needed = false;

    foreach ($children as $i => &$child) {
        $result_node[$i] = false;

        if (array_key_exists("children", $child) &&
            reresult_node_nodes_recursive($child["children"], $target_val) || 
            $child["val"] === $target_val) {
            $result_node[$i] = true;
            $sort_is_needed = true;
        }
    }

    if ($sort_is_needed) {
        $priority_nodes = [];
        $non_priority_nodes = [];

        for ($i = 0; $i < count($children); $i++) {
            if ($result_node[$i]) {
                $priority_nodes[]= $children[$i];
            }
            else {
                $non_priority_nodes[]= $children[$i];
            }
        }

        $children = array_merge($priority_nodes, $non_priority_nodes);
    }

    return $sort_is_needed;
}


$tree = [
    "val" => 1,
    "children" => [
        [
            "val" => 1,
            "children" => [
                ["val" => 7]
            ]
        ],
        [
            "val" => 3,
            "children" => [
                ["val" => 55]
            ]
        ],
        [
            "val" => 2,
            "children" => [
                ["val" => 15]
            ]
        ],
        [
            "val" => 7,
            "children" => [
                ["val" => 2]
            ]
        ]
    ]
  ];
echo json_encode(prioritize_nodes($tree, 3));
