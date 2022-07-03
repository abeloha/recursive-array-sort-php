Consider the following recursively-defined tree structure:

    const tree = {
      val: 1,
      children: [
        {val: 2},
        {
          val: 3,
          children: [
            {
              val: 4,
              children: [
                {val: 5},
                {val: 6},
                {val: 7}
              ]
            }
          ]
        }
      ]
    };
    

Here, each node in the tree is an object with a required "val" property that maps to a non-unique integer and an optional "children" property that, if present, maps to an array of child nodes. There will only be a single root node in the outermost object.

This challenge involves writing a function prioritizeNodes(tree, targetVal) which accepts a valid nested tree object conforming to the above definition. The function should sort all "children" arrays containing one or more nodes with node.val === targetVal to the front of the array. For the above tree, the output for a call to prioritizeNodes(tree, 7) would be:

    const expected = {
      val: 1,
      children: [
        {
          val: 3,
          children: [
            {
              val: 4,
              children: [
                {val: 7},
                {val: 5},
                {val: 6}
              ]
            }
          ]
        },
        {val: 2}
      ]
    };
    

Each node in a tree with a value or child matching the target was moved to the front of its respective array.

Non-prioritized nodes should be kept in their original relative ordering with respect to one another, and prioritized nodes which were moved to the front of an array should also maintain order with respect to other priority nodes in the array. Your function may mutate the parameter tree in-place in addition to returning it if you wish.

Examples
--------

**Example 1**

    const tree = {val: 1};
    prioritizeNodes(tree, 1); // => {val: 1}
    This is a trivial example.
    

**Example 2**

    const tree = {
      val: 1,
      children: [
        {
          val: 1,
          children: [
            {val: 7}
          ]
        },
        {
          val: 3,
          children: [
            {val: 55}
          ]
        },
        {
          val: 2,
          children: [
            {val: 15}
          ]
        },
        {
          val: 7,
          children: [
            {val: 2}
          ]
        }
      ]
    };
    

A call to prioritizeNodes(tree, 2) on the above structure should return

    const expected = {
      val: 1,
      children: [
        {
          val: 2, // <-- this moved up
          children: [
            {val: 15}
          ]
        },
        {
          val: 7, // <-- this moved up because its child has a val of 2
          children: [
            {val: 2}
          ]
        },
        {
          val: 1,
          children: [
            {val: 7}
          ]
        },
        {
          val: 3,
          children: [
            {val: 55}
          ]
        }
      ]
    };
    

Note that the parent node with value 7 was considered to be prioritized because it contained a descendent with a value matching the target. All children of the root maintained relative ordering after moving high-priority nodes to the front.

**Example 3**

    const tree = {
      val: 1,
      children: [
        {
          val: 2,
          children: [
            {
              val: 7,
              children: [
                {val: 2},
                {val: 18},
                {val: 12}
              ]
            }
          ]
        },
        {
          val: 4,
          children: [
            {val: 5},
            {
              val: 6,
              children: [
                {val: 12},
                {val: 11},
                {val: 10},
                {val: 9},
              ]
            },
            {val: 13}
          ]
        },
        {
          val: 3,
          children: [
            {val: 15}
          ]
        },
        {
          val: 17,
          children: [
            {val: 16},
            {
              val: 2,
              children: [
                {val: 14},
                {val: 11},
                {
                  val: 18,
                  children: [
                    {val: 4},
                    {val: 11},
                    {val: 7}
                  ]
                },
                {val: 27},
                {val: 18},
                {val: 29},
              ]
            }
          ]
        }
      ]
    };
    

In this large example, prioritizeNodes(tree, 18) is expected to return

    const expected = {
      val: 1,
      children: [
        {
          val: 2,
          children: [
            {
              val: 7,
              children: [
                {val: 18}, // <-- this moved up
                {val: 2},
                {val: 12}
              ]
            }
          ]
        },
        {
          val: 17, // <-- this moved up
          children: [
            {
              val: 2, // <-- this moved up
              children: [
                {
                  val: 18, // <-- this moved up
                  children: [
                    {val: 4},
                    {val: 11},
                    {val: 7}
                  ]
                },
                {val: 18}, // <-- this moved up
                {val: 14},
                {val: 11},
                {val: 27},
                {val: 29},
              ]
            },
            {val: 16}
          ]
        },
        {
          val: 4,
          children: [
            {val: 5},
            {
              val: 6,
              children: [
                {val: 12},
                {val: 11},
                {val: 10},
                {val: 9},
              ]
            },
            {val: 13}
          ]
        },
        {
          val: 3,
          children: [
            {val: 15}
          ]
        }
      ]
    };