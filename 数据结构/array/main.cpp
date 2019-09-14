#include <iostream>
#include "stdlib.h"
#include "SplArray.h"
#include "../stack/cases/BaseClass.h"

using namespace std;

int main()
{
    SplArray<BaseClass> *p = new SplArray<BaseClass>(10);

    BaseClass *b1 = new BaseClass(10,5);
    BaseClass *b2 = new BaseClass(3,5);
    BaseClass *b3 = new BaseClass(4,5);
    // 传递的是指针 需要*p才能取到元素
    p->insert(0, b1);
    p->insert(1, b2);
    p->insert(2, b3);
    cout << "length:"  << p->length() << endl;
    p->traverse();

    p->remove(1);
    p->traverse();

    cout << "success" << endl;
    return 0;
}