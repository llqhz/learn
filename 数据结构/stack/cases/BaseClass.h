#ifndef BASE_CLASS_H
#define BASE_CLASS_H

#include <ostream>

using namespace std;

class BaseClass
{
    protected:
        int x1 = 0;
        int y1 = 0;

    public:
        int getX();
        int getY();
        BaseClass(int x, int y);

    // 友元函数 运算符重载 
    friend ostream &operator<<(ostream &out, BaseClass &baseClass);
};

BaseClass::BaseClass(int x = 0, int y = 0)
{
    this->x1 = x;
    this->y1 = y;
}

int BaseClass::getX()
{
    return this->x1;
}

int BaseClass::getY()
{
    return this->y1;
}

// 友元函数 运算符重载 
ostream &operator<<(ostream &out, BaseClass &baseClass)
{
    out << "(" << baseClass.getX() << "," << baseClass.getY() << ")";
    return out;
}

#endif