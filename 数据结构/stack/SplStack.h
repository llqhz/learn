#ifndef SPL_STACK_H
#define SPL_STACK_H

#include <iostream>
using namespace std;

template <typename T>
class SplStack
{
    protected:
        T *pStack;
        int capacity;
        int iTop;

    public:
        SplStack(int capacity);
        ~SplStack();
        bool isEmpty();
        bool isFull();
        void clear();
        int length();
        bool push(T elem);
        bool pop(T &elem);
        void traverse();
};

template <typename T>
SplStack<T>::SplStack(int capacity)
{
    this->capacity = capacity;
    this->pStack = new T[capacity];
    this->iTop = 0;
}

template <typename T>
SplStack<T>::~SplStack()
{
    delete []this->pStack;
    this->pStack = nullptr;
}

template <typename T>
bool SplStack<T>::isEmpty()
{
    return this->iTop == 0 ? true : false;
}

template <typename T>
bool SplStack<T>::isFull()
{
    return this->iTop == this->capacity ? true : false;
}

template <typename T>
void SplStack<T>::clear()
{
    this->iTop = 0;
}

template <typename T>
int SplStack<T>::length()
{
    return this->iTop;
}

template <typename T>
bool SplStack<T>::push(T elem)
{
    if (this->isFull())
    {
        return false;
    }
    this->pStack[this->iTop] =  elem;
    this->iTop++;
    return true;
}

template <typename T>
bool SplStack<T>::pop(T &elem)
{
    if (this->isEmpty())
    {
        return false;
    }
    this->iTop--;
    elem = this->pStack[this->iTop];
    return true;
}

template <typename T>
void SplStack<T>::traverse()
{
    for (int i = 0; i < this->iTop; i++)
    {
        cout << this->pStack[i] << endl;
    }
}

#endif