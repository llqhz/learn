#include <iostream>
#include <stdlib.h>
#include "SplQueue.cpp"

using namespace std;

int main()
{
    SplQueue *p = new SplQueue(4);
    
    // 测试空队列
    p->traverse();

    // 测试入队
    for (int i = 0; i < 10; i++)
    {
        cout << "enQueue: " << i << endl;
        p->enQueue(i);
    }
    p->traverse();

    // 测试出队
    int elm = -1;
    for (int i = 0; i < 11; i++)
    {
        p->deQueue(elm);
        cout << "deQueue: " << elm << endl;
    }
    p->traverse();


    // 测试清空队列
    for (int i = 0; i < 10; i++)
    {
        p->enQueue(i);
    }
    p->clearQueue();
    p->traverse();
    
    delete p;
    p = nullptr;
    cout << "success" << endl;
    return 0;
}