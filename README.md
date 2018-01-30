# Nodeflow

A simple flow controller with features

* Every state is a node.
* A flow have one head node and one or multiple tail nodes.
* A middle node is a node who is neither head node nor tail node.
* An tail node can have one or multiple in nodes and have no out node.
* A head node can have one or multiple out nodes and have no in node.
* A middle node can have one or multiple in node and one or multiple out nodes.
* The road between two adjacent nodes could be one way or two way


## Concepts

### In/Out node

When node A has way to node B, A is B's in node and B is A's out node. 

## Contract

### Define a graph in PHP array

The first key must be the head node.

```PHP
[
    'blank' => ['editing', 'canceled'],
    'editing' => ['draft', 'canceled'],
    'draft' => ['editing', 'published', 'canceled'],
    'published' => ['draft', 'printed', 'canceled'],
    'printed' => [],
    'canceled' => [],
]
```

The equivalent graph 
 
![graph](https://github.com/limen/resources/blob/master/graph.png)

The arrow shows the way direction. 
