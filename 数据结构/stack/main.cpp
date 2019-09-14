#include <iostream>
#include "stdlib.h"
#include "SplStack.h"
#include "cases/BaseClass.h"

using namespace std;

int main()
{
    SplStack<int> *p =  new SplStack<int>(4);  // int 类型的栈
    
    // 测试空栈
    p->traverse();

    // 测试入栈
    for (int i = 0; i < 10; i++)
    {
        cout << "push: " << i << endl;
        p->push(i);
    }
    p->traverse();

    cout << "is full: " << p->isFull() << endl;
    cout << "stack length: " << p->length() << endl;

    // 测试出栈
    int elm = -1;
    for (int i = 0; i < 11; i++)
    {
        p->pop(elm);
        cout << "pop: " << elm << endl;
    }
    p->traverse();


    // 测试清空栈
    for (int i = 0; i < 10; i++)
    {
        p->push(i);
    }
    p->clear();
    p->traverse();
    
    cout << "is empty: " << p->isEmpty() << endl;

    delete p;
    p = nullptr;

    // 测试其他类
    SplStack<BaseClass> *np = new SplStack<BaseClass>(5);

    cout << "isEmpty:" << np->isEmpty() << endl;

    BaseClass *b = new BaseClass(1, 3);
    np->push(*b);

    np->traverse();

    cout << "length:" << np->length() << endl;
    
    delete np;
    np = nullptr;
    cout << "success" << endl;
    return 0;

}

